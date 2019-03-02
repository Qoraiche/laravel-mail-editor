@extends('maileclipse::layout.app')

@section('title', 'Create Template')

@section('content')

<!-- <span class="badge font-weight-light badge-secondary">
                GET
     </span> -->

     {{-- {{ dd($templates->all()) }} --}}

     {{-- {{ dd($skeleton) }} --}}

     <style type="text/css">
         
        .CodeMirror {
            height: 400px;
        }

        .editor-preview-active,
        .editor-preview-active-side {
            /*display:block;*/
        }
        .editor-preview-side>p,
        .editor-preview>p {
            margin:inherit;
        }
        .editor-preview pre,
        .editor-preview-side pre {
             background:inherit;
             margin:inherit;
        }
        .editor-preview table td,
        .editor-preview table th,
        .editor-preview-side table td,
        .editor-preview-side table th {
         border:inherit;
         padding:inherit;
        }
        .view_data_param {
            cursor: pointer;
        }

     </style>

<div class="col-lg-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('templateList') }}">Templates</a></li>
        <li class="breadcrumb-item active">{{ ucfirst($skeleton['type']) }}</li>
        <li class="breadcrumb-item active">{{ ucfirst($skeleton['name']) }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($skeleton['skeleton']) }}</li>
      </ol>
    </nav>
        <div class="container">
            <div class="row my-4">
                {{-- <div class="col-12 mb-2 d-block d-lg-none">
                    <div id="accordion">
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h5 class="mb-0 dropdown-toggle" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Details
                          </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Status:</b> Published</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Last edit:</b> 1 minute ago</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Revisions:</b> 3</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Published on:</b> Apr 14,2015 @ 11:04</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Source:</b> index.markdown.lala</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Mailable:</b> <a href="#sexymail">SexyMail</a></p>
                            <!-- <p class="text-danger"><i class="fas fa-trash align-middle"></i><a href="#">Send to trash</a></p> -->
                            <p class="text-danger"><i class="fas fa-trash"></i> Send to trash</p>
                        </div>
                        </div>
                      </div>
                    </div>
                </div> --}}
                <div class="col-md-12">

                    <div class="card mb-2">
                        <div class="card-header p-3" style="border-bottom:1px solid #e7e7e7e6;">
                            <button type="button" class="btn btn-primary float-right save-template">Create</button>
                            <button type="button" class="btn btn-secondary float-right preview-toggle mr-2"><i class="far fa-eye"></i> Preview</button>
                            {{-- <button type="button" class="btn btn-light float-right mr-2 save-draft">Save Draft</button> --}}
                        </div>
                    </div>

                    <div class="card">
                    
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Editor</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Plain Text</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <textarea id="template_editor" cols="30" rows="10">{{ $skeleton['template'] }}</textarea>
                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <textarea id="plain_text" cols="30" rows="10"></textarea>
                      </div>
                    </div>

                    </div>
                </div>
               {{--  <div class="col-lg-3 d-none d-lg-block">
                    <div class="card">
                        <div class="card-header"><h5>Details</h5></div>
                        <div class="card-body">
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Status:</b> Published</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Last edit:</b> 1 minute ago</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Revisions:</b> 3</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Published on:</b> Apr 14,2015 @ 11:04</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Source:</b> index.markdown.lala</p>
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">Mailable:</b> <a href="#sexymail">SexyMail</a></p>
                            <!-- <p class="text-danger"><i class="fas fa-trash align-middle"></i><a href="#">Send to trash</a></p> -->
                            <p class="text-danger"><i class="fas fa-trash"></i> Send to trash</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>       
 </div>

                <!-- <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between"><h5>Mailable Details</h5>
                    </div>
                    <div class="card-body card-bg-secondary">
                        <table class="table mb-0 table-borderless">
                            <tbody>
                                <tr>
                                    <td class="table-fit font-weight-sixhundred">Time</td>
                                    <td>
                                        January 14th 2019, 3:40:00 PM (14m ago)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-fit font-weight-sixhundred">Hostname</td>
                                    <td>
                                        MacBook-Pro-de-Mac.local
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-fit font-weight-sixhundred">Command</td>
                                    <td>
                                        make:mail
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-fit font-weight-sixhundred">Exit Code</td>
                                    <td>
                                        <a href="#">hahahha</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-fit font-weight-sixhundred">Tags</td>
                                    <td><a href="/telescope/mail?tag=yassine%40hotmail.com" class="badge badge-info mr-1 font-weight-light">
                            yassine@hotmail.com
                        </a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->

                <!-- Card with pills navigation 6-->
                <!-- <div class="card mb-4">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="#" class="nav-link active">Log Message</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Context</a></li>
                    </ul>
                </div> -->
                <!-- /Card-->

                <!--- STATISTICS -->

                <!-- <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between"><h5>Statistics</h5>
                        <ul class="nav nav-pills btn-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Daily</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Weekly</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Monthly</a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-row flex-wrap justify-content-between p-4 bottom-radius card-bg-secondary statistics-items text-center">
                        <div class="flex-fill p-2 border-right">
                            <h5 class="mb-3">Delivered</h5>
                            <h4 class="font-weight-bold mb-3">16 <span style="font-size: 0.5em;" class="badge font-weight-normal badge-success ml-1 align-middle">
                <i class="fas fa-angle-up"></i> 20%
            </span></h4>
                            <span>Yesterday <strong>5</strong></span>
                        </div>
                        <div class="flex-fill p-2 border-right">
                            <h5 class="mb-3">Opened</h5>
                            <h4 class="font-weight-bold mb-3">16 <span style="font-size: 0.5em;" class="badge font-weight-normal badge-danger ml-1 align-middle">
                <i class="fas fa-angle-down"></i> 20%
            </span></h4>
                            <span>Yesterday <strong>5</strong></span>
                        </div>
                        <div class="flex-fill p-2 border-right">
                            <h5 class="mb-3">Clicked</h5>
                            <h4 class="font-weight-bold mb-3">16 <span style="font-size: 0.5em;" class="badge font-weight-normal badge-success ml-1 align-middle">
                <i class="fas fa-angle-up"></i> 20%
            </span></h4>
                            <span>Yesterday <strong>5</strong></span>
                        </div>
                        <div class="flex-fill p-2 border-right">
                            <h5 class="mb-3">Top Mailable</h5>
                            <h5 class="mb-3 text-secondary">App/Mail/<span class="text-primary">Verification</span></h5>
                            <span>Yesterday <strong>Welcome</strong></span>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 card-bg-secondary">
                    <canvas id="myChart"></canvas>
                </div> -->




                
                
                <!-- <div class="d-flex flex-wrap">
                    <h5 class="mr-auto mb-sm-4">
                  E-mail Templates
                  <small class="text-muted">Select a template and create something beautiful</small>
                </h5> -->
                <!-- <p class="bd-highlight text-muted">3 Templates found</p> -->
                <!-- <div><a href="#" class="btn btn-primary btn-md">New Template</a></div>
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-center mt-4">
                    <div class="card flex-fill" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Sparkdown</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Genrate Sparkdown</a>
                        </div>
                    </div>
                    <div class="card flex-fill" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Markdown Editor</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-secondary">Create Markdown</a>
                        </div>
                    </div>
                    <div class="card flex-fill" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">E-Mail Editor</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-secondary">Create Template</a>
                        </div>
                    </div>
                </div> -->
            

<script type="text/javascript">

    
$(document).ready(function(){

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            // });

            @if ($skeleton['type'] === 'markdown')
            

            var simplemde = new SimpleMDE(
                {
                element: $("#template_editor")[0],
                toolbar: [
                {
                        name: "bold",
                        action: SimpleMDE.toggleBold,
                        className: "fa fa-bold",
                        title: "Bold",
                },
                {
                        name: "italic",
                        action: SimpleMDE.toggleItalic,
                        className: "fa fa-italic",
                        title: "Italic",
                },
                {
                        name: "strikethrough",
                        action: SimpleMDE.toggleStrikethrough,
                        className: "fa fa-strikethrough",
                        title: "Strikethrough",
                },
                {
                        name: "heading",
                        action: SimpleMDE.toggleHeadingSmaller,
                        className: "fa fa-header",
                        title: "Heading",
                },
                {
                        name: "code",
                        action: SimpleMDE.toggleCodeBlock,
                        className: "fa fa-code",
                        title: "Code",
                },
                /*{
                        name: "quote",
                        action: SimpleMDE.toggleBlockquote,
                        className: "fa fa-quote-left",
                        title: "Quote",
                },*/
                "|",
                {
                        name: "unordered-list",
                        action: SimpleMDE.toggleBlockquote,
                        className: "fa fa-list-ul",
                        title: "Generic List",
                },
                {
                        name: "uordered-list",
                        action: SimpleMDE.toggleOrderedList,
                        className: "fa fa-list-ol",
                        title: "Numbered List",
                },
                {
                        name: "clean-block",
                        action: SimpleMDE.cleanBlock,
                        className: "fa fa-eraser fa-clean-block",
                        title: "Clean block",
                },
                "|",
                {
                        name: "link",
                        action: SimpleMDE.drawLink,
                        className: "fa fa-link",
                        title: "Create Link",
                },
                {
                        name: "image",
                        action: SimpleMDE.drawImage,
                        className: "fa fa-picture-o",
                        title: "Insert Image",
                },
                {
                        name: "horizontal-rule",
                        action: SimpleMDE.drawHorizontalRule,
                        className: "fa fa-minus",
                        title: "Insert Horizontal Line",
                },
                "|",
                {
                    name: "button-component",
                    action: setButtonComponent,
                    className: "fa fa-hand-pointer-o",
                    title: "Button Component",
                },
                {
                    name: "table-component",
                    action: setTableComponent,
                    className: "fa fa-table",
                    title: "Table Component",
                },
                {
                    name: "promotion-component",
                    action: setPromotionComponent,
                    className: "fa fa-bullhorn",
                    title: "Promotion Component",
                },
                {
                    name: "panel-component",
                    action: setPanelComponent,
                    className: "fa fa-thumb-tack",
                    title: "Panel Component",
                },
                "|",
                {
                        name: "side-by-side",
                        action: SimpleMDE.toggleSideBySide,
                        className: "fa fa-columns no-disable no-mobile",
                        title: "Toggle Side by Side",
                },
                {
                        name: "fullscreen",
                        action: SimpleMDE.toggleFullScreen,
                        className: "fa fa-arrows-alt no-disable no-mobile",
                        title: "Toggle Fullscreen",
                },
                {
                        name: "preview",
                        action: SimpleMDE.togglePreview,
                        className: "fa fa-eye no-disable",
                        title: "Toggle Preview",
                },
                ],
                renderingConfig: { singleLineBreaks: true, codeSyntaxHighlighting: true,},
                hideIcons: ["guide"],
                spellChecker: false,
                promptURLs: true,
                placeholder: "Write your Beautiful Email",

                previewRender: function(plainText, preview) {
                     // return preview.innerHTML = 'sacas';
                    $.ajax({
                          method: "POST",
                          url: "{{ route('previewTemplateMarkdownView') }}",
                          data: { markdown: plainText, name: 'new' }
                        
                    }).done(function( HtmledTemplate ) {
                        preview.innerHTML = HtmledTemplate;
                    });

                    return '';
                },

            });

            function setButtonComponent(editor) {

                link = prompt('Button Link');

                var cm = editor.codemirror;
                var output = '';
                var selectedText = cm.getSelection();
                var text = selectedText || 'Button Text';

                output = `
[component]: # ('mail::button',  ['url' => '`+ link +`'])
` + text + `
[endcomponent]: # 
                `;
                cm.replaceSelection(output);

            }

            function setPromotionComponent(editor) {

                var cm = editor.codemirror;
                var output = '';
                var selectedText = cm.getSelection();
                var text = selectedText || 'Promotion Text';

                output = `
[component]: # ('mail::promotion')
` + text + `
[endcomponent]: # 
                `;
                cm.replaceSelection(output);

            }

            function setPanelComponent(editor) {

                var cm = editor.codemirror;
                var output = '';
                var selectedText = cm.getSelection();
                var text = selectedText || 'Panel Text';

                output = `
[component]: # ('mail::panel')
` + text + `
[endcomponent]: # 
                `;
                cm.replaceSelection(output);

            }

            function setTableComponent(editor) {

                var cm = editor.codemirror;
                var output = '';
                var selectedText = cm.getSelection();

                output = `
[component]: # ('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
[endcomponent]: # 
                `;
                cm.replaceSelection(output);

            }

            $('.preview-toggle').click(function(){
                simplemde.togglePreview();
                $(this).toggleClass('active');
            });

            @else

            tinymce.init({
                selector: "textarea#template_editor",
                menubar : false,
                visual: false,
                height:600,
                plugins: [
                     "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                     "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                     "save table directionality emoticons template paste fullpage"
               ],
               content_css: "css/content.css",
               toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image fullpage | forecolor backcolor emoticons | preview",
               fullpage_default_encoding: "UTF-8",
               fullpage_default_doctype: "<!DOCTYPE html>",
               init_instance_callback: function (editor) 
               {
                setTimeout(function(){ 
                    editor.execCommand("mceRepaint");
                }, 5000);
               }
            });


            

            $('.preview-toggle').click(function(){
                tinyMCE.execCommand('mcePreview');return false;
            });

            @endif

            $('.save-template').click(function(){

                notie.input({
                  text: 'Enter the template name:',
                  type: 'text',
                  placeholder: 'e.g. Weekly Newsletter',
                  allowed: new RegExp('[^a-zA-Z0-9 ]', 'g'),
                  submitCallback: function (templatename) {

                    notie.input({

                  text: 'Enter the template description:',
                  type: 'text',
                  submitText: 'Create Template',
                  cancelText: 'Cancel',
                  allowed: new RegExp('[^a-zA-Z0-9 ]', 'g'),
                  submitCallback: function (templatedescription) {

                    @if ($skeleton['type'] === 'markdown')

                    var postData = {
                        content: simplemde.codemirror.getValue(), 
                        template_name: templatename,
                        template_description: templatedescription,
                        plain_text: plaintextEditor.getValue(),
                        template_view_name: '{{ $skeleton['name'] }}',
                        template_type: '{{ $skeleton['type'] }}',
                        template_skeleton: '{{ $skeleton['skeleton'] }}',
                    }

                    @else

                    var postData = {
                        content: tinymce.get('template_editor').getContent(),
                        template_name: templatename,
                        template_description: templatedescription,
                        plain_text: plaintextEditor.getValue(),
                        template_view_name: '{{ $skeleton['name'] }}',
                        template_type: '{{ $skeleton['type'] }}',
                        template_skeleton: '{{ $skeleton['skeleton'] }}',
                    }

                    @endif

                    
                        axios.post('{{ route('createNewTemplate') }}', postData)

                    .then(function (response) {

                        if (response.data.status == 'ok'){

                            notie.alert({ type: 1, text: response.data.message, time: 3 });

                            setTimeout(function(){
                                window.location.replace(response.data.template_url);
                            }, 1000);

                        } else {
                            notie.alert({ type: 'error', text: response.data.message, time: 2 })
                        }
                    })

                    .catch(function (error) {
                        notie.alert({ type: 'error', text: error, time: 2 })
                    });
                  }

              });

             },

            });

            });


            var plaintextEditor = CodeMirror.fromTextArea(document.getElementById("plain_text"), {
                lineNumbers: false,
                mode: 'plain/text',
                placeholder: "Email Plain Text Version (Optional)",
            });

        });

                
</script>
   
@endsection