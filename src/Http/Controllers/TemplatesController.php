<?php

namespace qoraiche\mailEclipse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use qoraiche\mailEclipse\mailEclipse;

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
        $skeletons = mailEclipse::getTemplateSkeletons();

        $templates = mailEclipse::getTemplates();

        return View(mailEclipse::$view_namespace.'::sections.templates', compact('skeletons', 'templates'));
    }

    public function new($type, $name, $skeleton)
    {
        $type = $type === 'html' ? $type : 'markdown';

        $skeleton = mailEclipse::getTemplateSkeleton($type, $name, $skeleton);

        return View(mailEclipse::$view_namespace.'::sections.create-template', compact('skeleton'));
    }

    public function view($templateslug = null)
    {
        $template = mailEclipse::getTemplate($templateslug);

        if (is_null($template)) {
            return redirect()->route('templateList');
        }

        return View(mailEclipse::$view_namespace.'::sections.edit-template', compact('template'));
    }

    public function create(Request $request)
    {
        return mailEclipse::createTemplate($request);
    }

    public function select(Request $request)
    {
        $skeletons = mailEclipse::getTemplateSkeletons();

        return View(mailEclipse::$view_namespace.'::sections.new-template', compact('skeletons'));
    }

    public function previewTemplateMarkdownView(Request $request)
    {
        return mailEclipse::previewMarkdownViewContent(false, $request->markdown, $request->name, true);
    }

    public function delete(Request $request)
    {
        if (mailEclipse::deleteTemplate($request->templateslug)) {
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
        return mailEclipse::updateTemplate($request);
    }
}
