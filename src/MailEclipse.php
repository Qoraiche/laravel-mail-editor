<?php

namespace Qoraiche\MailEclipse;

use ErrorException;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Qoraiche\MailEclipse\Utils\Replacer;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReeceM\Mocker\Mocked;
use ReflectionClass;
use ReflectionProperty;
use RegexIterator;

/**
 * Class MailEclipse.
 */
class MailEclipse
{
    public const VIEW_NAMESPACE = 'maileclipse';

    public const VERSION = '4.0.3';

    /**
     * Default type examples for being passed to reflected classes.
     *
     * @var array TYPES
     */
    public const TYPES = [
        'int' => 31,
        'string' => null,
        'bool' => false,
        'float' => 3.14159,
        'iterable' => null,
        'array' => null,
    ];

    public static $traversed = 0;

    /**
     * @return array
     *
     * @throws \ReflectionException
     */
    public static function getMailables()
    {
        return self::mailablesList();
    }

    /**
     * @param  $key
     * @param  $name
     * @return Collection
     *
     * @throws \ReflectionException
     */
    public static function getMailable($key, $name): Collection
    {
        return collect(self::getMailables())->where($key, $name);
    }

    /**
     * @param  $templateSlug
     * @return bool
     */
    public static function deleteTemplate($templateSlug): bool
    {
        $template = self::getTemplates()
            ->where('template_slug', $templateSlug)->first();

        if ($template !== null) {
            self::saveTemplates(self::getTemplates()->reject(function ($value) use ($template) {
                return $value->template_slug === $template->template_slug;
            }));

            $template_view = self::VIEW_NAMESPACE.'::templates.'.$templateSlug;
            $template_plaintext_view = $template_view.'_plain_text';

            if (View::exists($template_view)) {
                unlink(View($template_view)->getPath());

                // remove plain text template version when exists
                if (View::exists($template_plaintext_view)) {
                    unlink(View($template_plaintext_view)->getPath());
                }

                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public static function getTemplatesFile()
    {
        $file = config('maileclipse.mailables_dir').'templates.json';
        if (! file_exists($file)) {
            if (! file_exists(config('maileclipse.mailables_dir'))) {
                if (! mkdir($concurrentDirectory = config('maileclipse.mailables_dir')) && ! is_dir($concurrentDirectory)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
                }
            }
            file_put_contents($file, '[]');
        }

        return $file;
    }

    /**
     * Save templates to templates.json file.
     *
     * @param  Collection  $templates
     */
    public static function saveTemplates(Collection $templates): void
    {
        file_put_contents(self::getTemplatesFile(), $templates->toJson());
    }

    /**
     * @param  $request
     * @return JsonResponse|null
     */
    public static function updateTemplate($request): ?JsonResponse
    {
        $template = self::getTemplates()
            ->where('template_slug', $request->templateslug)->first();

        if ($template !== null) {
            if (! preg_match("/^[a-zA-Z0-9-_\s]+$/", $request->title)) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Template name not valid',
                ]);
            }

            $templateName = Str::camel(preg_replace('/\s+/', '_', $request->title));

            if (self::getTemplates()->contains('template_slug', '=', $templateName)) {
                return response()->json([

                    'status' => 'failed',
                    'message' => 'Template name already exists',

                ]);
            }

            // Update
            $oldForm = self::getTemplates()->reject(function ($value) use ($template) {
                return $value->template_slug === $template->template_slug;
            });
            $newForm = array_merge($oldForm->toArray(), [array_merge((array) $template, [
                'template_slug' => $templateName,
                'template_name' => $request->title,
                'template_description' => $request->description,
            ])]);

            self::saveTemplates(collect($newForm));

            $template_view = self::VIEW_NAMESPACE.'::templates.'.$request->templateslug;
            $template_plaintext_view = $template_view.'_plain_text';

            if (View::exists($template_view)) {
                $viewPath = View($template_view)->getPath();

                rename($viewPath, dirname($viewPath)."/{$templateName}.blade.php");

                if (View::exists($template_plaintext_view)) {
                    $textViewPath = View($template_plaintext_view)->getPath();

                    rename($textViewPath, dirname($viewPath)."/{$templateName}_plain_text.blade.php");
                }
            }

            return response()->json([
                'status' => 'ok',
                'message' => 'Updated Successfully',
                'template_url' => route('viewTemplate', ['templatename' => $templateName]),
            ]);
        }
    }

    /**
     * @param  $templateSlug
     * @return Collection|null
     */
    public static function getTemplate($templateSlug): ?Collection
    {
        $template = self::getTemplates()->where('template_slug', $templateSlug)->first();

        if ($template !== null) {
            $template_view = self::VIEW_NAMESPACE.'::templates.'.$template->template_slug;
            $template_plaintext_view = $template_view.'_plain_text';

            if (View::exists($template_view)) {
                $viewPath = View($template_view)->getPath();
                $textViewPath = View($template_plaintext_view)->getPath();

                /** @var Collection $templateData */
                $templateData = collect([
                    'template' => Replacer::toEditor(file_get_contents($viewPath)),
                    'plain_text' => View::exists($template_plaintext_view) ? file_get_contents($textViewPath) : '',
                    'slug' => $template->template_slug,
                    'name' => $template->template_name,
                    'description' => $template->template_description,
                    'template_type' => $template->template_type,
                    'template_view_name' => $template->template_view_name,
                    'template_skeleton' => $template->template_skeleton,
                ]);

                return $templateData;
            }
        }
    }

    /**
     * Get templates collection.
     *
     * @return Collection
     */
    public static function getTemplates(): Collection
    {
        return collect(json_decode(file_get_contents(self::getTemplatesFile())));
    }

    /**
     * @param  $request
     * @return JsonResponse
     */
    public static function createTemplate($request): JsonResponse
    {
        if (! preg_match("/^[a-zA-Z0-9-_\s]+$/", $request->template_name)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Template name not valid',

            ]);
        }

        $view = self::VIEW_NAMESPACE.'::templates.'.$request->template_name;
        $templateName = Str::camel(preg_replace('/\s+/', '_', $request->template_name));

        if (! view()->exists($view) && ! self::getTemplates()->contains('template_slug', '=', $templateName)) {
            self::saveTemplates(self::getTemplates()
                ->push([
                    'template_name' => $request->template_name,
                    'template_slug' => $templateName,
                    'template_description' => $request->template_description,
                    'template_type' => $request->template_type,
                    'template_view_name' => $request->template_view_name,
                    'template_skeleton' => $request->template_skeleton,
                ]));

            $dir = resource_path('views/vendor/'.self::VIEW_NAMESPACE.'/templates');

            if (! File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            file_put_contents($dir."/{$templateName}.blade.php", Replacer::toBlade($request->content));

            file_put_contents($dir."/{$templateName}_plain_text.blade.php", $request->plain_text);

            return response()->json([
                'status' => 'ok',
                'message' => 'Template created<br> <small>Reloading...<small>',
                'template_url' => route('viewTemplate', ['templatename' => $templateName]),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Template not created',

        ]);
    }

    protected static function markdownedTemplate($viewPath)
    {
        $viewContent = file_get_contents($viewPath);

        return Replacer::toEditor($viewContent);
    }

    /**
     * Markdowned template view.
     */
    public static function markdownedTemplateToView($save = true, $content = '', $viewPath = '', $template = false)
    {
        if ($template && View::exists(self::VIEW_NAMESPACE.'::templates.'.$viewPath)) {
            $viewPath = View(self::VIEW_NAMESPACE.'::templates.'.$viewPath)->getPath();
        }

        $replaced = Replacer::toBlade($content);

        if (! $save) {
            return $replaced;
        }

        return file_put_contents($viewPath, $replaced) !== false;
    }

    /**
     * @param  $simpleview
     * @param  $content
     * @param  $viewName
     * @param  bool  $template
     * @param  null  $namespace
     * @return bool|string|void
     *
     * @throws \ReflectionException
     */
    public static function previewMarkdownViewContent($simpleview, $content, $viewName, $template = false, $namespace = null)
    {
        $previewtoset = self::markdownedTemplateToView(false, $content);
        $dir = dirname(__FILE__, 2).'/resources/views/draft';
        $viewName = $template ? $viewName.'_template' : $viewName;

        if (file_exists($dir)) {
            file_put_contents($dir."/{$viewName}.blade.php", $previewtoset);

            if ($template) {
                $instance = null;
            } elseif (self::handleMailableViewDataArgs($namespace) !== null) {
                $instance = self::handleMailableViewDataArgs($namespace);
            } else {
                $instance = new $namespace;
            }

            return self::renderPreview($simpleview, self::VIEW_NAMESPACE.'::draft.'.$viewName, $template, $instance);
        }

        return false;
    }

    /**
     * @param  $instance
     * @param  $view
     * @return string|void
     */
    public static function previewMarkdownHtml($instance, $view)
    {
        return self::renderPreview($instance, $view);
    }

    /**
     * @param  $mailableName
     * @return array|bool
     */
    public static function getMailableTemplateData($mailableName)
    {
        $mailable = self::getMailable('name', $mailableName);

        if ($mailable->isEmpty()) {
            return false;
        }

        $templateData = collect($mailable->first())->only(['markdown', 'view_path', 'text_view_path', 'text_view', 'view_data', 'data', 'namespace'])->all();

        $templateExists = $templateData['view_path'] !== null;
        $textTemplateExists = $templateData['text_view_path'] !== null;

        if ($templateExists) {
            $viewPathParams = collect($templateData)->union([

                'text_template' => $textTemplateExists ? file_get_contents($templateData['text_view_path']) : null,
                'template' => file_get_contents($templateData['view_path']),
                'markdowned_template' => self::markdownedTemplate($templateData['view_path']),
                'template_name' => $templateData['markdown'] ?? $templateData['data']->view,
                'is_markdown' => $templateData['markdown'] !== null,
            ])->all();

            return $viewPathParams;
        }

        return $templateData;
    }

    /**
     * @param  null  $request
     * @return JsonResponse
     */
    public static function generateMailable($request = null): JsonResponse
    {
        $name = self::generateClassName($request->input('name'));
        $defaultDirectory = 'Mail';

        $mailableDir = config('maileclipse.mailables_dir');
        $customPath = substr($mailableDir, strpos($mailableDir, $defaultDirectory) + strlen($defaultDirectory) + 1);

        if ($name === false) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wrong name format.',
            ]);
        }

        if (! $request->has('force') && ! self::getMailable('name', $name)->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'This mailable name already exists. names should be unique! to override it, enable "force" option.',
            ]);
        }

        if (strtolower($name) === 'mailable') {
            return response()->json([
                'status' => 'error',
                'message' => 'You cannot use "mailable" as a mailable name',
            ]);
        }

        $name = $customPath ? $customPath.'/'.$name : $name;

        $params = collect([
            'name' => $name,
        ]);

        if ($request->input('markdown')) {
            $params->put('--markdown', $request->markdown);
        }

        if ($request->has('force')) {
            $params->put('--force', true);
        }

        $exitCode = Artisan::call('make:mail', $params->all());

        if ($exitCode > -1) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Mailable Created<br> <small>Reloading...<small>',
            ]);
        }

        return response()->json([

            'status' => 'error',
            'message' => 'mailable not created successfully',

        ]);
    }

    /**
     * Get Mailables list.
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    protected static function mailablesList()
    {
        $fqcns = [];

        if (! file_exists(config('maileclipse.mailables_dir'))) {
            return;
        } else {
            $allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(config('maileclipse.mailables_dir')));
            $phpFiles = new RegexIterator($allFiles, '/\.php$/');
            $i = 0;

            foreach ($phpFiles as $phpFile) {
                $i++;
                $content = file_get_contents($phpFile->getRealPath());
                $tokens = token_get_all($content);
                $namespace = '';
                for ($index = 0; isset($tokens[$index]); $index++) {
                    if (! isset($tokens[$index][0])) {
                        continue;
                    }
                    if (T_NAMESPACE === $tokens[$index][0]) {
                        $index += 2; // Skip namespace keyword and whitespace
                        while (isset($tokens[$index]) && is_array($tokens[$index])) {
                            $namespace .= $tokens[$index++][1];
                        }
                    }
                    if (T_CLASS === $tokens[$index][0] && T_WHITESPACE === $tokens[$index + 1][0] && T_STRING === $tokens[$index + 2][0]) {
                        $index += 2; // Skip class keyword and whitespace

                        [$name, $extension] = explode('.', $phpFile->getFilename());

                        $mailableClass = $namespace.'\\'.$tokens[$index][1];

                        if (! self::mailable_exists($mailableClass)) {
                            continue;
                        }

                        $reflector = new ReflectionClass($mailableClass);

                        if ($reflector->isAbstract()) {
                            continue;
                        }

                        $mailable_data = self::buildMailable($mailableClass);

                        if (! is_null(self::handleMailableViewDataArgs($mailableClass))) {
                            $mailable_view_data = self::getMailableViewData(self::handleMailableViewDataArgs($mailableClass), $mailable_data);
                        } else {
                            $mailable_view_data = self::getMailableViewData(new $mailableClass, $mailable_data);
                        }

                        $fqcns[$i]['data'] = $mailable_data;
                        $fqcns[$i]['markdown'] = self::getMarkdownViewName($mailable_data);
                        $fqcns[$i]['name'] = $name;
                        $fqcns[$i]['namespace'] = $mailableClass;
                        $fqcns[$i]['filename'] = $phpFile->getFilename();
                        $fqcns[$i]['modified'] = $phpFile->getCTime();
                        $fqcns[$i]['viewed'] = $phpFile->getATime();
                        $fqcns[$i]['view_data'] = $mailable_view_data;
                        // $fqcns[$i]['view_data'] = [];
                        $fqcns[$i]['path_name'] = $phpFile->getPathname();
                        $fqcns[$i]['readable'] = $phpFile->isReadable();
                        $fqcns[$i]['writable'] = $phpFile->isWritable();
                        $fqcns[$i]['view_path'] = null;
                        $fqcns[$i]['text_view_path'] = null;

                        /** @see \Illuminate\Mail\Mailable@buildSubject for the Str Functions, used to keep consistent. */
                        $fqcns[$i]['subject'] = $mailable_data->subject ?? Str::title(Str::snake(class_basename($mailableClass), ' '));

                        if (! is_null($fqcns[$i]['markdown']) && View::exists($fqcns[$i]['markdown'])) {
                            $fqcns[$i]['view_path'] = View($fqcns[$i]['markdown'])->getPath();
                        }

                        if (! is_null($fqcns[$i]['data'])) {
                            if (! is_null($fqcns[$i]['data']->view) && View::exists($fqcns[$i]['data']->view)) {
                                $fqcns[$i]['view_path'] = View($fqcns[$i]['data']->view)->getPath();
                            }

                            if (! is_null($fqcns[$i]['data']->textView) && View::exists($fqcns[$i]['data']->textView)) {
                                $fqcns[$i]['text_view_path'] = View($fqcns[$i]['data']->textView)->getPath();
                                $fqcns[$i]['text_view'] = $fqcns[$i]['data']->textView;
                            }
                        }

                        // break if you have one class per file (psr-4 compliant)
                        // otherwise you'll need to handle class constants (Foo::class)
                        break;
                    }
                }
            }

            $collection = collect($fqcns)->map(function ($mailable) {
                return $mailable;
            })->reject(function ($object) {
                return ! array_search(
                    'Illuminate\Contracts\Mail\Mailable',
                    class_implements($object['namespace']
                    ));
            });

            return $collection;
        }
    }

    /**
     * Handle Mailable Constructor arguments and pass the fake ones.
     *
     * @param  $mailable
     * @return object|void
     *
     * @throws \ReflectionException
     */
    public static function handleMailableViewDataArgs($mailable)
    {
        if (method_exists($mailable, '__construct')) {
            $reflection = new ReflectionClass($mailable);

            $params = $reflection->getConstructor()->getParameters();

            DB::beginTransaction();

            $eloquentFactory = app(EloquentFactory::class);

            $args = collect($params)->map(function ($param) {
                if ($param->getType() !== null) {
                    if (class_exists($param->getType()->getName())) {
                        $parameters = [
                            'is_instance' => true,
                            'instance' => $param->getType()->getName(),
                        ];
                    } elseif ($param->getType()->getName() === 'array') {
                        $parameters = [
                            'is_array' => true,
                            'arg' => $param->getName(),
                        ];
                    } else {
                        $parameters = $param->name;
                    }

                    return $parameters;
                }

                return $param->name;
            });

            $resolvedTypeHints = [];

            foreach ($args->all() as $arg) {
                if (is_array($arg)) {
                    if (isset($arg['is_instance'])) {
                        $model = $arg['instance'];

                        self::$traversed = 0;

                        $factoryModel = self::resolveFactory($eloquentFactory, $model);

                        $resolvedTypeHints[] = $factoryModel
                            ? self::hydrateRelations($eloquentFactory, $factoryModel)
                            : $factoryModel;
                    } elseif (isset($arg['is_array'])) {
                        $resolvedTypeHints[] = [];
                    } else {
                        return;
                    }
                } else {
                    $resolvedTypeHints[] = self::getMissingParams($arg, $params);
                }
            }

            $reflector = new ReflectionClass($mailable);

            if ($args->isNotEmpty()) {
                $resolvedTypeHints = array_filter($resolvedTypeHints);

                return $reflector->newInstanceArgs($resolvedTypeHints);
            }

            DB::rollBack();
        }
    }

    /**
     * Gets any missing params that may not be collectable in the reflection.
     *
     * @param  string  $arg  the argument string|array
     * @param  array  $params  the reflection param list
     * @return array|string|\ReeceM\Mocker\Mocked
     */
    private static function getMissingParams($arg, $params)
    {
        /**
         * Determine if a builtin type can be found.
         * Not a string or object as a Mocked::class can work there.
         *
         * getName() is undocumented alternative to casting to string.
         * https://www.php.net/manual/en/class.reflectiontype.php#124658
         *
         * @var \ReflectionNamedType|null $reflection
         */
        $reflection = collect($params)->where('name', $arg)->first()->getType() ?? null;

        try {
            if (is_null($reflection)) {
                return new Mocked($arg, \ReeceM\Mocker\Utils\VarStore::singleton());
            }

            $type = version_compare(phpversion(), '7.1', '>=')
                ? $reflection->getName()
                : /** @scrutinizer ignore-deprecated */ $reflection->__toString();

            return array_key_exists($type, self::TYPES)
                ? self::TYPES[$type]
                : new Mocked($arg, \ReeceM\Mocker\Utils\VarStore::singleton());
        } catch (\Exception $e) {
            return $arg;
        }
    }

    /**
     * @param  $mailable
     * @param  $mailable_data
     * @return array|Collection
     *
     * @throws \ReflectionException
     */
    private static function getMailableViewData($mailable, $mailable_data)
    {
        $traitProperties = [];

        $data = new ReflectionClass($mailable);

        foreach ($data->getTraits() as $trait) {
            foreach ($trait->getProperties(ReflectionProperty::IS_PUBLIC) as $traitProperty) {
                $traitProperties[] = $traitProperty->name;
            }
        }

        $properties = $data->getProperties(ReflectionProperty::IS_PUBLIC);
        $allProps = [];

        foreach ($properties as $prop) {
            if ($prop->class == $data->getName() || $prop->class == get_parent_class($data->getName()) &&
                    get_parent_class($data->getName()) != 'Illuminate\Mail\Mailable' && ! $prop->isStatic()) {
                $allProps[] = $prop->name;
            }
        }

        $obj = self::buildMailable($mailable);

        if ($obj === null) {
            $obj = [];

            return collect($obj);
        }

        $classProps = array_diff($allProps, $traitProperties);

        $withFuncData = collect($obj->buildViewData())->keys();

        $mailableData = collect($classProps)->merge($withFuncData);

        $data = $mailableData->map(function ($parameter) use ($mailable_data) {
            return [
                'key' => $parameter,
                'value' => property_exists($mailable_data, $parameter) ? $mailable_data->$parameter : null,
                'data' => property_exists($mailable_data, $parameter) ? self::viewDataInspect($mailable_data->$parameter) : null,
            ];
        });

        return $data->all();
    }

    /**
     * @param  $param
     * @return array
     */
    protected static function viewDataInspect($param): ?array
    {
        if ($param instanceof \Illuminate\Database\Eloquent\Model) {
            return [
                'type' => 'model',
                'attributes' => collect($param->getAttributes()),
            ];
        }

        if ($param instanceof \Illuminate\Database\Eloquent\Collection) {
            return [
                'type' => 'elequent-collection',
                'attributes' => $param->all(),
            ];
        }

        if ($param instanceof \Illuminate\Support\Collection) {
            return [
                'type' => 'collection',
                'attributes' => $param->all(),
            ];
        }

        return null;
    }

    /**
     * @param  $mailable
     * @return bool
     */
    protected static function mailable_exists($mailable): bool
    {
        if (! class_exists($mailable)) {
            return false;
        }

        return true;
    }

    /**
     * @param  $mailable
     * @return mixed|void
     *
     * @throws \ReflectionException
     */
    protected static function getMarkdownViewName($mailable)
    {
        if ($mailable === null) {
            return;
        }

        $reflection = new ReflectionClass($mailable);

        $property = $reflection->getProperty('markdown');

        $property->setAccessible(true);

        if (method_exists($mailable, 'content')) {
            return app()->call([new $mailable, 'content'])->markdown;
        }

        return $property->getValue($mailable);
    }

    /**
     * @param  $instance
     * @param  string  $type
     * @return mixed
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    public static function buildMailable($instance, $type = 'call')
    {
        $method = method_exists($instance, 'build') ? 'build' : 'content';

        if ($type === 'call') {
            if (self::handleMailableViewDataArgs($instance) !== null) {
                return self::handleMailableViewDataArgs($instance);
            }

            if ($method == 'content') {
                /** @var \Illuminate\Mail\Mailable */
                $class = new $instance;
                $class->view(app()->call([new $instance, 'content'])->view);

                return $class;
            }

            return app()->call([new $instance, $method]);
        }

        return app()->make($instance);
    }

    /**
     * @param  $simpleview
     * @param  $view
     * @param  bool  $template
     * @param  null  $instance
     * @return string|void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    public static function renderPreview($simpleview, $view, $template = false, $instance = null)
    {
        if (! View::exists($view)) {
            return;
        }

        if (! $template) {
            $obj = self::buildMailable($instance);
            $viewData = $obj->buildViewData();
            $_data = array_merge($instance->buildViewData(), $viewData);

            foreach ($_data as $key => $value) {
                if (! is_object($value)) {
                    $_data[$key] = '<span class="maileclipse-key" title="Variable">'.$key.'</span>';
                }
            }
        } else {
            $_data = [];
        }

        $_view = $view;

        try {
            if ($simpleview) {
                return htmlspecialchars_decode(view($_view, $_data)->render());
            }

            $_md = self::buildMailable(Markdown::class, 'make');

            return htmlspecialchars_decode($_md->render($_view, $_data));
        } catch (ErrorException $e) {
            $error = '<div class="alert alert-warning">
	    	<h5 class="alert-heading">Error:</h5>
	    	<p>'.$e->getMessage().'</p>
	    	</div>';

            if ($template) {
                $error .= '<div class="alert alert-info">
				<h5 class="alert-heading">Notice:</h5>
				<p>You can\'t add variables within a template editor because they are undefined until you bind the template with a mailable that actually has data.</p>
	    	</div>';
            }

            return $error;
        }
    }

    /**
     * Class name has to satisfy those rules.
     *
     * https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.class
     * https://www.php.net/manual/en/reserved.keywords.php
     *
     * @param  $input
     * @return string|false class name or false on failure
     */
    public static function generateClassName($input)
    {
        $suffix = 'Mail';

        if (strtolower($input) === strtolower($suffix)) {
            return false;
        }

        // Avoid MailMail as a class name suffix
        $suffix = substr_compare($input, 'mail', -4, 4, true) === 0
            ? ''
            : $suffix;

        /**
         * - Suffix is needed to avoid usage of reserved word.
         * - Str::slug will remove all forbidden characters.
         */
        $name = Str::studly(Str::slug($input, '_')).$suffix;

        /**
         * Removal of reserved keywords.
         */
        if (! preg_match('/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/', $name) ||
            substr_compare($name, $suffix, -strlen($suffix), strlen($suffix), true) !== 0
        ) {
            return false;
        }

        return $name;
    }

    /**
     * Resolves the factory result for a model and returns the hydrated instance.
     *
     * @todo Allow the values for the Make command to be passed down by the pkg.
     *
     * @param  $eloquentFactory
     * @param  $model
     * @return null|object
     */
    private static function resolveFactory($eloquentFactory, $model): ?object
    {
        if (! config('maileclipse.factory')) {
            return app($model);
        }

        // factory builder backwards compatibility
        if (isset($eloquentFactory[$model]) && function_exists('factory')) {
            return call_user_func_array('factory', [$model])->make();
        }

        /** @var array|false $modelHasFactory */
        $modelHasFactory = class_uses($model);

        if (isset($modelHasFactory['Illuminate\Database\Eloquent\Factories\HasFactory'])) {
            return $model::factory()->make();
        }

        $action = sprintf('php artisan make:factory %sFactory --model=%s', Str::of($model)->afterLast('\\'), $model);

        throw new \Exception("No Factory found, maileclipse.factory config is true. But there is no Factory. Create using $action");
    }

    /**
     * single level relation resolving for a model.
     * It will load the relations or set to mocked class.
     *
     * @param  mixed  $eloquentFactory
     * @param  mixed  $factoryModel
     * @return null|object
     */
    private static function hydrateRelations($eloquentFactory, $factoryModel): ?object
    {
        if (config('maileclipse.relations.relation_depth', 1) === 0) {
            return $factoryModel;
        }

        if (self::$traversed >= 5) {
            Log::warning('[MailEclipse]: more than 5 calls to relation loader', ['last_model' => get_class($factoryModel) ?? 'model unknown']);
            self::$traversed = 6;

            return $factoryModel;
        }

        $model = new ReflectionClass(config('maileclipse.relations.model', \Illuminate\Foundation\Auth\User::class));

        self::$traversed += 1;

        collect((new ReflectionClass($factoryModel))->getMethods())
            ->filter(function (\ReflectionMethod $method) use ($model) {
                return ! $model->hasMethod($method->getName());
            })
            ->filter(function (\ReflectionMethod $method) use ($factoryModel) {
                if ($method->getNumberOfParameters() >= 1) {
                    return false;
                }

                $parents = rescue(function () use ($method, $factoryModel) {
                    $methodName = $method->getName();

                    return $method->hasReturnType()
                        ? class_parents($method->getReturnType()->getName())
                        : class_parents($factoryModel->$methodName());
                }, [], false);

                return isset($parents["Illuminate\Database\Eloquent\Relations\Relation"]);
            })
            ->each(function (\ReflectionMethod $relationName) use (&$factoryModel, $eloquentFactory) {
                $factoryModel = self::loadRelations($relationName->getName(), $factoryModel, $eloquentFactory);
            });

        return $factoryModel;
    }

    /**
     * Load the relations for the model and the relation.
     *
     * @todo Account for the many type relations, link back to parent model for belongsTo
     *
     * @param  mixed  $relationName
     * @param  mixed  $factoryModel
     * @param  mixed|null  $eloquentFactory
     * @return null|object
     */
    public static function loadRelations($relationName, $factoryModel, $eloquentFactory = null): ?object
    {
        try {
            $factoryModel->load($relationName);

            $loadIfIterable = is_iterable($factoryModel->$relationName) && count($factoryModel->$relationName) <= 0;

            if (is_null($factoryModel->$relationName) || $loadIfIterable) {
                $related = $factoryModel->$relationName()->getRelated();
                $relatedFactory = self::resolveFactory($eloquentFactory, get_class($related));

                if (self::$traversed <= config('maileclipse.relations.relation_depth')) {
                    if (! $loadIfIterable) {
                        $relatedFactory = self::hydrateRelations($eloquentFactory, $relatedFactory);
                    } else {
                        $models = collect();

                        for ($loads = 0; $loads < 3; $loads++) {
                            $models->push(self::hydrateRelations($eloquentFactory, $relatedFactory));
                        }

                        $relatedFactory = $models;
                    }
                }

                $factoryModel->setRelation(
                    $relationName,
                    $relatedFactory
                );
            }
        } catch (\Throwable $th) {
            $factoryModel->setRelation(
                $relationName,
                new Mocked(
                    'relation_is_null',
                    \ReeceM\Mocker\Utils\VarStore::singleton()
                )
            );
        } finally {
            return $factoryModel;
        }
    }

    /**
     * @param  string  $name
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     * @throws \ReflectionException
     */
    public static function renderMailable(string $name)
    {
        $mailable = self::getMailable('name', $name)->first();

        if (collect($mailable['data'])->isEmpty()) {
            return false;
        }

        $mailableInstance = self::resolveMailableInstance($mailable);

        $view = $mailable['markdown'] ?? $mailable['data']->view;

        if (view()->exists($view)) {
            return $mailableInstance->render();
        }

        return view(self::VIEW_NAMESPACE.'::previewerror', ['errorMessage' => 'No template associated with this mailable.']);
    }

    /**
     * @param  string  $name
     * @param  string  $recipient
     */
    public static function sendTest(string $name, string $recipient): void
    {
        $mailable = self::getMailable('name', $name)->first();

        $mailableInstance = self::resolveMailableInstance($mailable);

        $mailableInstance = self::setMailableSendTestRecipient($mailableInstance, $recipient);

        Mail::send($mailableInstance);
    }

    /**
     * @param  $mailable
     * @param  string  $email
     * @return mixed
     */
    public static function setMailableSendTestRecipient($mailable, string $email)
    {
        $mailable->to($email);
        $mailable->cc([]);
        $mailable->bcc([]);

        return $mailable;
    }

    /**
     * @param  $mailable
     * @return object|void
     *
     * @throws \ReflectionException
     */
    private static function resolveMailableInstance($mailable)
    {
        if (self::handleMailableViewDataArgs($mailable['namespace']) !== null) {
            $mailableInstance = self::handleMailableViewDataArgs($mailable['namespace']);
        } else {
            $mailableInstance = new $mailable['namespace'];
        }

        return $mailableInstance;
    }
}
