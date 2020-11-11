<?php

namespace Qoraiche\MailEclipse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Qoraiche\MailEclipse\MailEclipse;

class MailablesController extends Controller
{
    public function __construct()
    {
        abort_unless(
            App::environment(config('maileclipse.allowed_environments', ['local'])),
            403
      );
    }

    public function toMailablesList()
    {
        return redirect()->route('mailableList');
    }

    public function index()
    {
        $mailables = MailEclipse::getMailables();

        $mailables = (null !== $mailables) ? $mailables->sortBy('name') : collect([]);

        return view(MailEclipse::$view_namespace.'::sections.mailables', compact('mailables'));
    }

    public function generateMailable(Request $request)
    {
        return MailEclipse::generateMailable($request);
    }

    public function viewMailable($name)
    {
        $mailable = MailEclipse::getMailable('name', $name);

        if ($mailable->isEmpty()) {
            return redirect()->route('mailableList');
        }

        $resource = $mailable->first();

        return view(MailEclipse::$view_namespace.'::sections.view-mailable')->with(compact('resource'));
    }

    public function editMailable($name)
    {
        $templateData = MailEclipse::getMailableTemplateData($name);

        if (! $templateData) {
            return redirect()->route('viewMailable', ['name' => $name]);
        }

        return view(MailEclipse::$view_namespace.'::sections.edit-mailable-template', compact('templateData', 'name'));
    }

    public function templatePreviewError()
    {
        return view(MailEclipse::$view_namespace.'::previewerror');
    }

    public function parseTemplate(Request $request)
    {
        $template = $request->has('template') ? $request->template : false;

        $viewPath = $request->has('template') ? $request->viewpath : base64_decode($request->viewpath);

        // ref https://regexr.com/4dflu
        $bladeRenderable = preg_replace('/((?!{{.*?-)(&gt;)(?=.*?}}))/', '>', $request->markdown);

        if (MailEclipse::markdownedTemplateToView(true, $bladeRenderable, $viewPath, $template)) {
            return response()->json([
                'status' => 'ok',
            ]);
        }

        return response()->json([
            'status' => 'error',
        ]);
    }

    public function previewMarkdownView(Request $request)
    {
        return MailEclipse::previewMarkdownViewContent(false, $request->markdown, $request->name, false, $request->namespace);
    }

    public function previewMailable($name)
    {
        return MailEclipse::renderMailable($name);
    }

    public function delete(Request $request)
    {
        $mailableFile = config('maileclipse.mailables_dir').'/'.$request->mailablename.'.php';

        if (file_exists($mailableFile)) {
            unlink($mailableFile);

            return response()->json([
                'status' => 'ok',
            ]);
        }

        return response()->json([
            'status' => 'error',
        ]);
    }

    public function sendTest(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|nullable',
            'name' => 'string|required',
        ]);

        $email = $request->get('email') ?? config('maileclipse.test_mail');

        MailEclipse::sendTest($request->get('name'), $email);
    }
}
