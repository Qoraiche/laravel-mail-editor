<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Edit Template</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
	<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- tinymce -->
	@if ( isset($templateData['template_name']) && !$templateData['is_markdown'] )
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.0/tinymce.min.js"></script>
	@endif
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/xml/xml.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/css/css.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/javascript/javascript.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/htmlmixed/htmlmixed.js"></script>

	<style type="text/css">
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
</head>
<body>

	{{-- {{ dd($templateData) }} --}}

	@if (isset($templateData['template_name']))

	<div class="container mt-3">

		<div class="row">
			<div class="col-10 m-auto">
				
			<div class="card">
				  <div class="card-body">
				    <h5 class="card-title" style="color:#000;">Template Editor</h5>
				    <p class="card-text"><b>Mailable:</b> {{ $name }} <br> <b>{{ $templateData['is_markdown'] ? 'Markdown' : 'View' }}</b>: {{ $templateData['template_name'] }}</p>
				  </div>

				  <div class="card-header">
				    <span style="vertical-align: -moz-middle-with-baseline;">{{ $templateData['is_markdown'] ? __('Markdown Editor') : __('Edit View') }}</span>
				    <button type="button" class="btn btn-primary float-right save-view">Save</button>
				    	<button type="button" class="btn btn-secondary float-right preview-toggle mr-2">Preview</button>
				    	<button type="button" class="btn btn-light float-right mr-2 save-draft disabled">Save Draft</button>
				  </div>
				  <div class="card-header">
				    <h6 class="m-0">View Data: 
					@foreach($templateData['view_data'] as $param)
				    	<span class="badge badge-secondary view_data_param"><i class="fa fa-anchor mr-1" aria-hidden="true"></i>{{ $param }}</span>
				    @endforeach
				    </h6>
				  </div>



				  <div class="alert template-edit-status d-none"></div>

				  @if ( isset($templateData['template']) )

				  	@if ( $templateData['is_markdown'] )

				  		<textarea name="editor" id="editor" cols="30" rows="10">{!! $templateData['markdowned_template'] !!}</textarea>

				  	@else 

				  		{{-- <textarea id="code">{!! $templateData['template'] !!}</textarea> --}}

				  		<textarea id="tinymce">{!! $templateData['template'] !!}</textarea>

				  	@endif
				  	
				  @else
					
					<div class="alert alert-warning" role="alert">
						No Template found found for mailable ({{ $name }}).
					</div>
			
				  @endif

				  @if (!is_null($templateData['text_template']))

				  	<div class="alert text-template-edit-status d-none"></div>

					  <div class="card-header">
					    <span style="vertical-align: -moz-middle-with-baseline;">{{ __('Plain Text Version') }}</span>
					    <button type="button" class="btn btn-primary float-right save-text-view">Save</button>
					  </div>

					  <div><textarea id="text_view">{{ $templateData['text_template'] }}</textarea></div>

				  @endif

				 @if ( !$templateData['is_markdown'] )
				  <div class="card-header">
				    <span style="vertical-align: -moz-middle-with-baseline;">Preview</span>
				  </div>
				  <div id="view-preview"></div>
				 @endif

			</div>
			</div>
		</div>
		
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(document).ready(function(){


		@if ( isset($templateData['template']) )

				$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
				});


		var templateID = "template_view_{{ $name }}_{{ $templateData['template_name'] }}";

		@if ( $templateData['is_markdown'] )

			var simplemde = new SimpleMDE(
				{
				element: $("#editor")[0],
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
				/*{
						name: "table",
						action: SimpleMDE.drawTable,
						className: "fa fa-table",
						title: "Insert Table",
				},*/
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
				renderingConfig: { singleLineBreaks: false, codeSyntaxHighlighting: false,},
				hideIcons: ["guide"],
				spellChecker: false,
				promptURLs: true,
				placeholder: "Write your Beautiful Email",
				previewRender: function(plainText, preview) {
					$.ajax({
						  method: "POST",
						  url: "{{ route('previewMarkdownView') }}",
						  data: { markdown: plainText, namespace: '{{ addslashes($templateData['namespace']) }}', viewdata: "{{ serialize($templateData['view_data']) }}", name: '{{ $name }}' }
						
					}).done(function( HtmledTemplate ) {
					    preview.innerHTML = HtmledTemplate;
					});

					return '';
				},
				
			});

			function setButtonComponent(editor) {

			    var cm = editor.codemirror;
			    var output = '';
			    var selectedText = cm.getSelection();
			    var text = selectedText || 'Button Text';

			    output = `
[component]: # ('mail::button',  ['url' => ''])
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

			simplemde.codemirror.on("change", function(){
				if ($('.save-draft').hasClass('disabled')){
					$('.save-draft').removeClass('disabled').text('Save Draft');
				}

			});

			$('.save-draft').click(function(){
				if (!$('.save-draft').hasClass('disabled')){
					localStorage.setItem(templateID, simplemde.codemirror.getValue());
					$(this).addClass('disabled').text('Draft Saved');
				}
			});

			if (localStorage.getItem(templateID) !== null) {
				simplemde.value(localStorage.getItem(templateID));
			}

			$('.save-view').click(function(){

				localStorage.setItem(templateID, simplemde.codemirror.getValue());
				$('.save-draft').addClass('disabled').text('Draft Saved');

				$.ajax({
				  method: "POST",
				  url: "{{ route('parseTemplate') }}",
				  data: { markdown: simplemde.codemirror.getValue(), viewpath: "{{ $templateData['view_path'] }}" }
				})
				  .done(function( data ) 
				  {
				    if (data.status == 'ok'){
						    	$('.template-edit-status').removeClass('alert-warning d-none').addClass('alert-success').html('Saved successfully <a href="{{ route('viewMailable', ['name' => $name]) }}" class="float-right">View Mailable</a>');
				    } 

				    else {
				    	$('.template-edit-status').removeClass('alert-success d-none').addClass('alert-warning').text('Error, cannot save the template');
				    }
				  });
			});


			function viewMarkdownParser(plainText){

				$.ajax({
				  method: "POST",
				  url: "{{ route('previewMarkdownView') }}",
				  data: { 
				  	markdown: plainText, 
				  	namespace: '{{ addslashes($templateData['namespace']) }}', 
				  	viewdata: "{{ serialize($templateData['view_data']) }}", 
				  	name: '{{ $name }}' 
				  }
				
				}).done(function( HtmledTemplate ) {
					let data = HtmledTemplate;
				    console.log(data);
				  });

				  return data;
			}



			$('.view_data_param').click(function(){
					var cm = simplemde.codemirror;
				    var output = '';
				    var selectedText = cm.getSelection();
				    var param = $(this).text();

				    output = `\{\{ $` + param + ` \}\}`;

				    cm.replaceSelection(output);
				});

			/**
			 * 
			 *
			 * ########################################
			 *
			 * ----------- IF NOT MARKDOWN ------------
			 *
			 * ########################################
			 *
			 * 
			 */

				@else

	tinymce.init({
        selector: "textarea#tinymce",
        menubar : true,
        visual: false,
        height:560,
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
	    		editor.on('Change', function (e) {
	      			if ($('.save-draft').hasClass('disabled')){
						$('.save-draft').removeClass('disabled').text('Save Draft');
					}
	    		});

	    		if (localStorage.getItem(templateID) !== null) {
					editor.setContent(localStorage.getItem(templateID));
				}

				setTimeout(function(){ 
							editor.execCommand("mceRepaint");
						}, 2000);

	    	}

    });

		simplemde = null;


		$('.view_data_param').click(function(){
			var param = $(this).text();
			var output = `\{\{ $` + param + ` \}\}`;
			tinymce.activeEditor.selection.setContent(output);
		});

		/*var htmlEditor = CodeMirror.fromTextArea(document.getElementById("code"), {
			lineNumbers: false,
			mode: 'htmlmixed',
			// theme: 'default',
		});*/

		/*htmlEditor.on("change", function(){
			
			$.ajax({
			  method: "POST",
			  {{-- url: "{{ route('previewMarkdownView') }}", --}}
			  data: { 
			  	markdown: htmlEditor.getValue(), 
			  	{{-- namespace: '{{ addslashes($templateData['namespace']) }}',  --}}
			  	{{-- viewdata: "{{ serialize($templateData['view_data']) }}",  --}}
			  	{{-- name: '{{ $name }}'  --}}
			  }
			
		}).done(function( HtmledTemplate ) {
			    $('#view-preview').html(HtmledTemplate);
			});

		});

		*/

		$('.save-view').click(function(){

			$.ajax({
			  method: "POST",
			  url: "{{ route('parseTemplate') }}",
			  data: { 
			  	markdown: tinymce.get('tinymce').getContent(),
			  	viewpath: "{{ $templateData['view_path'] }}"
			 }
			})
			  .done(function( data ) {
			    if (data.status == 'ok'){
$('.template-edit-status').removeClass('alert-warning d-none').addClass('alert-success').html('Saved successfully <a href="{{ route('viewMailable', ['name' => $name]) }}" class="float-right">View Mailable</a>');
				localStorage.removeItem(templateID);
			    } else {
			    	$('.template-edit-status').removeClass('alert-success d-none').addClass('alert-warning').text('Error, cannot save the template');
			    }
			  });
		});


		$('.save-draft').click(function(){
			if (!$('.save-draft').hasClass('disabled')){
				localStorage.setItem(templateID, tinymce.get('tinymce').getContent());
				$(this).addClass('disabled').text('Draft Saved');
			}
		});

		 $('.preview-toggle').click(function(){
			tinyMCE.execCommand('mcePreview');return false;
		});

				@endif

		@if (!is_null($templateData['text_template']))

		var plaintextEditor = CodeMirror.fromTextArea(document.getElementById("text_view"), {
			lineNumbers: false,
			mode: 'plain/text',
			// theme: 'default',
		});


		$('.save-text-view').click(function(){

			$.ajax({
			  method: "POST",
			  url: "{{ route('parseTemplate') }}",
			  data: { markdown: plaintextEditor.getValue(), viewpath: "{{ $templateData['text_view_path'] }}" }
			})
			  .done(function( data ) {
			    if (data.status == 'ok'){
					    	$('.text-template-edit-status').removeClass('alert-warning d-none').addClass('alert-success').html('Saved successfully <a href="{{ route('viewMailable', ['name' => $name]) }}" class="float-right">View Mailable</a>');
			    } else {
			    	$('.text-template-edit-status').removeClass('alert-success d-none').addClass('alert-warning').text('Error, cannot save the text plain');
			    }
			  });
		});

		@endif

			@endif

		});
	</script>

	@else

		<div class="container mt-3">

		<div class="row">
			<div class="col-10 m-auto">

				<div class="alert alert-warning" role="alert">
				    <strong>Oops!</strong> We don't find any template associated with this mailable
				</div>

			</div>
		</div>
		</div>

	@endif

</body>
</html>