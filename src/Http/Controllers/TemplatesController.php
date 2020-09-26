<?php

namespace Qoraiche\MailEclipse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Qoraiche\MailEclipse\Facades\MailEclipse;
use Qoraiche\MailEclipse\Templates\TemplateSkeletons;

class TemplatesController extends Controller
{
    public function __construct()
    {
        abort_unless(
            App::environment(config('maileclipse.allowed_environments', ['local'])),
            403
        );
    }

    public function index()
    {
        $skeletons = (new TemplateSkeletons())->skeletons();

        $templates = MailEclipse::getTemplates();

        return View(MailEclipse::VIEW_NAMESPACE.'::sections.templates', compact('skeletons', 'templates'));
    }

    public function new($type, $name, $skeleton)
    {
        $type = $type === 'html' ? $type : 'markdown';

        $skeleton = (new TemplateSkeletons())->templateSkelton($type, $name, $skeleton);

        return View(MailEclipse::VIEW_NAMESPACE.'::sections.create-template', compact('skeleton'));
    }

    public function view($templateslug = null)
    {
        $template = MailEclipse::getTemplate($templateslug);

        if (is_null($template)) {
            return redirect()->route('templateList');
        }

        return View(MailEclipse::VIEW_NAMESPACE.'::sections.edit-template', compact('template'));
    }

    public function create(Request $request)
    {
        return MailEclipse::createTemplate($request);
    }

    public function select(Request $request)
    {
        $skeletons = (new TemplateSkeletons())->skeletons();

        return View(MailEclipse::VIEW_NAMESPACE.'::sections.new-template', compact('skeletons'));
    }

    public function previewTemplateMarkdownView(Request $request)
    {
        return MailEclipse::previewMarkdownViewContent(false, $request->markdown, $request->name, true);
    }

    public function delete(Request $request)
    {
        if (MailEclipse::deleteTemplate($request->templateslug)) {
            return response()->json([
                'status' => 'ok',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

    public function update(Request $request)
    {
        return MailEclipse::updateTemplate($request);
    }
}
