<?php

namespace Qoraiche\MailEclipse;

use Illuminate\Support\Facades\View;
use Qoraiche\MailEclipse\Facades\MailEclipse;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use RegexIterator;

class MailEclipseMailables
{
    public function __construct()
    {
        //
    }

    public static function get(string $name, string $key = 'name')
    {
        return collect(self::all())->where($key, $name);
    }

    /**
     * Get mailables list.
     *
     * @return array
     */
    public static function all()
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

                        if (! MailEclipse::mailable_exists($mailableClass)) {
                            continue;
                        }

                        $reflector = new ReflectionClass($mailableClass);

                        if ($reflector->isAbstract()) {
                            continue;
                        }

                        $mailable_data = MailEclipse::buildMailable($mailableClass);

                        if (! is_null(MailEclipse::handleMailableViewDataArgs($mailableClass))) {
                            $mailable_view_data = MailEclipse::getMailableViewData(MailEclipse::handleMailableViewDataArgs($mailableClass), $mailable_data);
                        } else {
                            $mailable_view_data = MailEclipse::getMailableViewData(new $mailableClass, $mailable_data);
                        }

                        $fqcns[$i]['data'] = $mailable_data;
                        $fqcns[$i]['markdown'] = MailEclipse::getMarkdownViewName($mailable_data);
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
                return ! method_exists($object['namespace'], 'build');
            });

            return $collection;
        }
    }
}
