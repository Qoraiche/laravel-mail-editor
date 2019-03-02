<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
	<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	@if ($template['template_type'] === 'html')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.0/tinymce.min.js"></script>
	@endif
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/xml/xml.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/css/css.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/javascript/javascript.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/htmlmixed/htmlmixed.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/display/placeholder.js"></script>

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
		/*.CodeMirror { border: 1px solid silver; }
        .CodeMirror-empty { outline: 1px solid #c22; }
        .CodeMirror-empty.CodeMirror-focused { outline: none; }
        .CodeMirror pre.CodeMirror-placeholder { color: #999; }*/
	</style>

</head>
<body>

	{{-- {{ dd($template) }} --}}
	
	<div class="container mt-3">
		
		<div class="row">
			<div class="col-12 m-auto">
				<div class="card">
					<div class="alert template-edit-status d-none"></div>
					<div class="card-header">
						<h4>{{ 'Edit Template: '.$template['name'] }}</h4>
						<p style="vertical-align: -moz-middle-with-baseline;">{{ $template['description'] }}</p>
						<a href="#" class="text-primary edit-template mr-3">Edit</a>
						<a href="#" class="text-danger delete-template">Delete</a>
				    	<button type="button" class="btn btn-primary float-right save-template">Save</button>
				    	<button type="button" class="btn btn-secondary float-right preview-toggle mr-2">Preview</button>
				    	<button type="button" class="btn btn-light float-right mr-2 save-draft disabled">Save Draft</button>
					</div>
					<div class="card-body">
						<textarea id="view" cols="30" rows="10">{{ $template['template'] }}</textarea>
					</div>
					<div class="card-header">
						<span style="vertical-align: -moz-middle-with-baseline;">Plain Text Version</span>
					</div>
					<div class="card-body">
						<textarea name="editor_plain_text" id="text_view" cols="30" rows="10" placeholder="Code goes here...">{{ $template['plain_text'] }}</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
				});

			var templateID = "{{ "template_view_".$template['slug'] }}";

			$('.edit-template').click(function(){
				var title = prompt('Title');

				if ( title !== null ){

				var description = prompt('Description');

					if (confirm('Update?')){
						$.ajax({
						  method: "POST",
						  url: "{{ route('updateTemplate') }}",
						  data: {
						  	templateslug: '{{ $template['slug'] }}',
						  	title: title,
						  	description: description,
						  }
						
					}).done(function( data ) {
					    if (data.status == 'ok'){

				    		window.location.replace(data.template_url);

					    } else {
					    	alert(data.message);
					    }
					});
					}
				}
			});

			$('.delete-template').click(function(){

				if (confirm('Are you sure you want to delete?')){

				$.ajax({
						  method: "POST",
						  url: "{{ route('deleteTemplate') }}",
						  data: { 
						  	templateslug: '{{ $template['slug'] }}',
						  }
						
					}).done(function( data ) {
					    if (data.status == 'ok'){

				    	alert('Deleted!');
				    	window.location.replace('{{ route('templateList') }}');

					    } else {
					    	alert(data.message);
					    }
					});

				}

			});

			@if ($template['template_type'] === 'markdown')

			var simplemde = new SimpleMDE(
				{
				element: $("#view")[0],
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
						  data: { markdown: plainText, name: '{{ $template['slug'] }}' }
						
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

			simplemde.codemirror.on("change", function(){
				if ($('.save-draft').hasClass('disabled')){
					$('.save-draft').removeClass('disabled').text('Save Draft');
				}
				// alert('Hello');
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

			$('.save-template').click(function(){
				$.ajax({
				  method: "POST",
				  url: "{{ route('parseTemplate') }}",
				  data: { markdown: simplemde.codemirror.getValue(), viewpath: "{{ $template['slug'] }}", template: true }
				})
				  .done(function( data ) {
				    if (data.status == 'ok'){
						    	$('.template-edit-status').removeClass('alert-warning d-none').addClass('alert-success').html('Template Saved successfully');
				    } else {
				    	$('.template-edit-status').removeClass('alert-success d-none').addClass('alert-warning').text('Error, cannot save the template');
				    }
				  });
			});

			$('.preview-toggle').click(function(){
				simplemde.togglePreview();
				$(this).toggleClass('active');
			});


			@else

				tinymce.init({
			        selector: "textarea#view",
			        menubar : true,
			        visual: false,
			        height:600,
			        plugins: [
			             "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			             "save table directionality emoticons template paste fullpage"
			       ],
			       content_css: "css/content.css",
			       toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image fullpage table | forecolor backcolor emoticons | preview",
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


			$('.save-template').click(function(){
				$.ajax({
				  method: "POST",
				  url: "{{ route('parseTemplate') }}",
				  data: { markdown: tinymce.get('view').getContent(), viewpath: "{{ $template['slug'] }}", template: true }
				})
				  .done(function( data ) {
				    if (data.status == 'ok'){
						    	$('.template-edit-status').removeClass('alert-warning d-none').addClass('alert-success').html('Template Saved successfully');

						    	localStorage.removeItem(templateID);
				    } else {
				    	$('.template-edit-status').removeClass('alert-success d-none').addClass('alert-warning').text('Error, cannot save the template');
				    }
				  });
			});

			$('.save-draft').click(function(){
				if (!$('.save-draft').hasClass('disabled')){
					localStorage.setItem(templateID, tinymce.get('view').getContent());
					$(this).addClass('disabled').text('Draft Saved');
				}
			});

			 $('.preview-toggle').click(function(){
				tinyMCE.execCommand('mcePreview');return false;
			});

			@endif

			var plaintextEditor = CodeMirror.fromTextArea(document.getElementById("text_view"), {
				lineNumbers: false,
				mode: 'plain/text',
				placeholder: "Email Plain Text Version (Optional)",
			});

			/*simplemde.codemirror.on("change", function(){
				if ($('.save-draft').hasClass('disabled')){
					$('.save-draft').removeClass('disabled').text('Save Draft');
				}
			});*/

		});

	</script>

</body>
</html>