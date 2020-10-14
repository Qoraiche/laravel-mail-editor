<?php

namespace Qoraiche\MailEclipse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Qoraiche\MailEclipse\MailEclipse;
use App\Product;
use Illuminate\Support\Str;
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
        $skeletons = MailEclipse::getTemplateSkeletons();

        $templates = MailEclipse::getTemplates();

        return View(MailEclipse::$view_namespace.'::sections.templates', compact('skeletons', 'templates'));
    }

    public function new($type, $name, $skeleton)
    {
        $type = $type === 'html' ? $type : 'markdown';

        $skeleton = MailEclipse::getTemplateSkeleton($type, $name, $skeleton);

        return View(MailEclipse::$view_namespace.'::sections.create-template', compact('skeleton'));
    }

    public function view($templateslug = null)
    {
        $template = MailEclipse::getTemplate($templateslug);

        if (is_null($template)) {
            return redirect()->route('templateList');
        }

        return View(MailEclipse::$view_namespace.'::sections.edit-template', compact('template'));
    }

    public function create(Request $request)
    {
        return MailEclipse::createTemplate($request);
    }

    public function select(Request $request)
    {
        $skeletons = MailEclipse::getTemplateSkeletons();

        return View(MailEclipse::$view_namespace.'::sections.new-template', compact('skeletons'));
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
    public function getTemplateProduct(request $request){
        $id = $request->input('productid');
        $productData = product::find($id);
        if(isset($productData)){
            return response()->json([
            'status'=>'success',
            'productName'=>$productData->name,
            'short_description'=>Str::limit($productData->short_description, 20, $end='...'),
            'price'=>'$'.$productData->price,
            'product_image'=>$productData->image,
            'product_url'=>'www.test.com',
        ]);
        }
        return response()->json(['status'=>'failed','message'=>'Product not found']);
    }
}
