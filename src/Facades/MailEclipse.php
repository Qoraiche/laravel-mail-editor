<?php

namespace Qoraiche\MailEclipse\Facades;

use Illuminate\Support\Facades\Facade;
use Qoraiche\MailEclipse\MailEclipse as MailEclipseParent;

/**
 * @method static \Illuminate\Support\Collection getMailables()
 * @method static \Illuminate\Support\Collection getMailable($key, $name)
 * @method static bool deleteTemplate($templateSlug)
 * @method static string getTemplatesFile()
 * @method static void saveTemplates(Collection $templates)
 * @method static \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory updateTemplate($request)
 * @method static \Illuminate\Support\Collection getTemplate($templateSlug)
 * @method static \Illuminate\Support\Collection getTemplates()
 * @method static \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory createTemplate($request)
 * @method static string markdownedTemplateToView($save = true, $content = '', $viewPath = '', $template = false)
 * @method static bool|mixed|string previewMarkdownViewContent($simpleview, $content, $viewName, $template = false, $namespace = null)
 * @method static mixed|string previewMarkdownHtml($instance, $view)
 * @method static array|bool getMailableTemplateData($mailableName)
 * @method static \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory generateMailable($request = null)
 * @method static array handleMailableViewDataArgs($mailable)
 * @method static \Illuminate\Contracts\Mail\Mailable|\Illuminate\Contracts\Support\Renderable buildMailable($instance, $type = 'call')
 * @method static void|string renderPreview($simpleview, $view, $template = false, $instance = null)
 * @method static void sendTest(string $name, string $recipient)
 *
 * @see \Qoraiche\MailEclipse\MailEclipse
 */
class MailEclipse extends Facade
{
    const VIEW_NAMESPACE = MailEclipseParent::VIEW_NAMESPACE;

    const VERSION = MailEclipseParent::VERSION;

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'maileclipse';
    }
}
