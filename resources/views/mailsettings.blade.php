<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }} - Settings</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>

	<div class="container mt-3">

		<h3>Settings</h3>

		<form class="form" action="{{ route('saveSettings') }}" method="POST">
			@csrf
		<div class="form-group">
		<label for="driver">Driver: {{ config('mail.driver') }}</label>
		</div>

		<hr>
		<div class="form-group">
			<label>From (<i>Address</i>)</label>
			<input type="text" class="form-control" value="{{ $maileclipse->getOptionNameSetting('from_address') }}" name="from[address]">
		</div>
		<div class="form-group">
			<label>From (<i>Name</i>)</label>
			<input type="text" class="form-control" value="{{ $maileclipse->getOptionNameSetting('from_name') }}" name="from[name]">
		</div>
		<hr>
		<div class="form-group">
			<label>Reply To (<i>Address</i>)</label>
			<input type="text" class="form-control" value="{{ $maileclipse->getOptionNameSetting('reply_to_address') }}" name="reply_to[address]">
		</div>

		<div class="form-group">
			<label>Reply To (<i>Name</i>)</label>
			<input type="text" class="form-control" value="{{ $maileclipse->getOptionNameSetting('reply_to_name') }}" name="reply_to[name]">
		</div>
		<hr>

		{{-- <div class="form-group">
			<label>Markdown Theme</label>
			<input type="text" class="form-control" value="{{ $maileclipse->getOptionNameSetting('markdown_theme') }}" name="markdown[theme]">
		</div> --}}

		<button type="submit" class="btn btn-primary">Save</button>
	</form>
		
	</div>

</body>
</html>