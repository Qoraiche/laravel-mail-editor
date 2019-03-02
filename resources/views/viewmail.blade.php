<!DOCTYPE html>
<html>
<head>
	<title>create mailable</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

	<style type="text/css">
		.template-props {
			background: #000;
		}
		.template-props pre code{
			color: #fff;
		}

		.template-props pre{
			padding: 10px;
		}
	</style>
</head>
<body>

	{{-- {{ dd($resource) }} --}}

	{{-- {{ dd(collect($resource['data']->from)->implode('address', ', ')) }} --}}

	<div class="container mt-3">

		<div class="row">
			<div class="col-8 m-auto">
				
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">{{ $resource['name'] }}</h5>
				    <p class="card-text">{{ $resource['namespace'] }}</p>
				  </div>
				  <div class="card-header">
				    {{ __('Details') }}
				  </div>
				  <ul class="list-group list-group-flush">
				  	
				  	@if ( !is_null($resource['data'] ) )

				  	{{-- {{ dd($resource['data']) }} --}}

				    @if ( !empty($resource['data']->locale) )
				    	<li class="list-group-item"><b>Locale:</b> {{ $resource['data']->locale }}</li>
				    @endif

				    <li class="list-group-item"><b>From:</b> {{ !empty($resource['data']->from) ? $resource['data']->from : config('mail.from.name') .' - '. config('mail.from.address') }}</li>
					
					@if ( !empty($resource['data']->subject) )
				    	<li class="list-group-item"><b>Subject:</b> {{ $resource['data']->subject }}</li>
				    @endif

				    @if ( !empty($resource['data']->cc) )
				    	<li class="list-group-item"><b>cc:</b> {{ collect($resource['data']->cc)->implode('address', ', ') }}</li>
				    @endif

				    @if ( !empty($resource['data']->bcc) )
				    	<li class="list-group-item"><b>bcc:</b> {{ collect($resource['data']->bcc)->implode('address', ', ') }}</li>
				    @endif

				    {{-- {{ dd($resource['data']->to) }} --}}

				   	@if ( !empty($resource['data']->to) )
				    	<li class="list-group-item"><b>To:</b> 
							{{ collect($resource['data']->to)->implode('address', ', ') }}
				    	</li>
				    @endif
	
					@if ( !empty($resource['data']->replyTo) )
				    	<li class="list-group-item"><b>Reply To:</b> {{ collect($resource['data']->replyTo)->implode('address', ', ') }}</li>

				    	@else 
						
						<li class="list-group-item"><b>Reply To:</b> {{ config('mail.reply_to.name') .' - '. config('mail.reply_to.address') }}</li>

				    @endif

				    {{-- <li class="list-group-item"><b>Last Viewed:</b> {{ date('Y-m-d H:i:s', $resource['viewed']) }}</li> --}}
				    {{-- {{ dd(\Carbon\Carbon::parse($resource['modified'])) }} --}}

				    

				  </ul>
				  {{-- <div class="card-body">
				    <a href="#" class="card-link">Edit Template</a>
				    <a href="#" class="card-link text-danger">Delete</a>
				  </div> --}}
				  <div>

				  <div class="card-header">
				    {{ __('Preview') }}
				    <a class="link-primary float-right" href="{{ route('editMailable', ['name' => $resource['name']]) }}">Edit template</a>
				  </div>

				  	<div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive-item" src="{{ route('previewMailable', [ 'name' => $resource['name'] ]) }}" allowfullscreen></iframe>
					</div>

					@endif
				  	
				  </div>
				  <div class="card-header">
				    Template Properties
				  </div>
				  <ul class="list-group list-group-flush">
				  	<li class="list-group-item template-props"><pre><code>{{ json_encode($resource['view_data']) }}</code></pre></li>
				  </ul>
				</div>

			</div>
		</div>

	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			

		});
	</script>

</body>
</html>