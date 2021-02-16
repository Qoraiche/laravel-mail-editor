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

        $templates = MailEclipse::getTemplates()->where('template_dynamic',FALSE);
        
        
        $templates_dynamic = MailEclipse::getTemplates()->where('template_dynamic',TRUE);
        
        
        return View(MailEclipse::$view_namespace.'::sections.templates', compact('skeletons', 'templates', 'templates_dynamic'));
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
        
        if( request('product_ids') ){
            
            $uniq = '-'.date('Y-m-d').'-'.rand(10000 , 99999);
            $view = MailEclipse::$view_namespace.'::templates.'.$templateslug.$uniq;
            
            $templatename = Str::camel(preg_replace('/\s+/', '_', $templateslug.$uniq));

            $old_template = MailEclipse::getTemplates()->where('template_slug', $templateslug)->first();

            if (! view()->exists($view) && ! MailEclipse::getTemplates()->contains('template_slug', '=', $templatename)) {
                MailEclipse::saveTemplates(MailEclipse::getTemplates()
                    ->push([
                        'template_name'        => $templateslug.$uniq,
                        'template_slug'        => $templatename,
                        'template_description' => $old_template->template_description,
                        'template_type'        => $old_template->template_type,
                        'template_view_name'   => $old_template->template_view_name,
                        'template_skeleton'    => $old_template->template_skeleton,
                        'template_dynamic'     => TRUE,
                    ]));

                $dir = resource_path('views/vendor/'.MailEclipse::$view_namespace.'/templates');

                if (! \File::isDirectory($dir)) {
                    \File::makeDirectory($dir, 0755, true);
                }

                file_put_contents($dir."/{$templatename}.blade.php", MailEclipse::templateComponentReplace($template['template']));

                file_put_contents($dir."/{$templatename}_plain_text.blade.php", '');
                
                $template = MailEclipse::getTemplate($templatename);
                // return redirect()->route('viewTemplate',['templatename']);
            }

            $product_ids = explode(',', request('product_ids'));

		    $productData = product::whereIn('id',$product_ids)->withMedia(config('constants.media_tags'))->get();

            $product_list = [];
            foreach ($productData as $key => $value) { 
                $img = $value->getMedia(config('constants.media_tags'))->first() ? $value->getMedia(config('constants.media_tags'))->first()->getUrl() : null;
                $product_list[] = array(
                    'name'  => $value->name,
                    'price' => $value->price,
                    'img'   => $img,
                );
            }

            $product_list = json_encode( $product_list );
        }

        if (is_null($template)) {
            return redirect()->route('templateList');
        }

        return View(MailEclipse::$view_namespace.'::sections.edit-template', compact('template','product_list'));
    }

    public function editPost()
    {   
        // dd(request()->all());
        $templateslug = request('mail_tpl');
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
