<!DOCTYPE html>
<html>
<head>
	<title>create mailable</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>

	<div class="container mt-3">

		<div class="row">
			<div class="col-8 m-auto">
				<h3>Create Mailable</h3>

	@if (session('error'))
		<div class="alert alert-danger">
	        {{ session('error') }}
	    </div>
	@endif

		<form class="form" action="{{ route('generateMailable') }}" method="POST">
			@csrf
		<div class="form-group">
			<label for="exampleInputName2">Name</label>
			<input type="text" class="form-control" name="name" placeholder="e.g Register User" required="">
		</div>
		<div class="form-group">
			<label class="checkbox-inline">
				<input type="checkbox" id="markdown--truth" value="option1""> Markdown Template
			</label>
		</div>
		<div class="form-group markdown" style="display: none;">
			<label for="markdownview">Markdown</label>
			<input type="text" class="form-control" name="markdown" id="markdownview" placeholder="eg. markdown.view">
		</div>
		<div class="form-group">
			<label class="checkbox-inline">
				<input type="checkbox" id="inlineCheckbox1" name="force"> Force Creation (<i>Override mailable if exists</i>)
			</label>
		</div>
		{{-- <div class="form-group">
			<label for="exampleInputEmail2">Template Type</label>
			<select class="c-select" name="template-type">
				<option selected>Select Template type</option>
				<option value="view">View</option>
				<option value="markdown">Markdown</option>
			</select>
		</div> --}}
		<button type="submit" class="btn btn-primary">Generate Mailable</button>
	</form>

			</div>
		</div>

		
		
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#markdown--truth').change(
    function(){
        if ($(this).is(':checked')) {
            
        	$('.markdown').show();
        } else {

        	$('.markdown').hide();
        }
    });

		});
	</script>

</body>
</html>