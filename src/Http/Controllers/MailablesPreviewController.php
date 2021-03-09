<?php

namespace Qoraiche\MailEclipse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Qoraiche\MailEclipse\Facades\MailEclipse;
use Qoraiche\MailEclipse\Http\Exceptions\PreviewErrorException;

class MailablesPreviewController extends Controller
{
    public function __construct()
    {
        abort_unless(
            App::environment(config('maileclipse.allowed_environments', ['local'])),
            403
        );
    }

    public function previewError()
    {
        return view(MailEclipse::VIEW_NAMESPACE.'::previewerror');
    }

    public function markdownView(Request $request)
    {
        return MailEclipse::previewMarkdownViewContent(false, $request->markdown, $request->name, false, $request->namespace);
    }

    public function mailable($name)
    {
        $mailable = MailEclipse::getMailable('name', $name);

        if ($mailable->isEmpty()) {
            return redirect()->route('mailableList');
        }

        $resource = $mailable->first();

        if (collect($resource['data'])->isEmpty()) {
            return 'View not found';
        }

        $instance = MailEclipse::handleMailableViewDataArgs($resource['namespace']);

        if (is_null($instance)) {
            $instance = new $resource['namespace'];
        }

        $view = ! is_null($resource['markdown'])
            ? $resource['markdown']
            : $resource['data']->view;

        if (view()->exists($view)) {
            try {
                $html = $instance;

                return $html->render();
            } catch (\ErrorException $e) {
                throw new PreviewErrorException($e);
            }
        }

        throw new PreviewErrorException(new \Exception('No template associated with this mailable.'));
    }
}
