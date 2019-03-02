<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

	{{-- {{ dd($templates->all()) }} --}}

	<div class="container mt-3">

		<h3>HTML Skeletons</h3>
		<hr>

		<div class="row">
		  @foreach( $skeletons->get('html') as $name => $subskeleton )
			 <div class="col-sm-6">
			  <div class="card">
			    <div class="card-body">
			      <h5 class="card-title">{{ ucfirst($name) }}</h5>
			      <div class="card-text">
			      	<ul class="list-group list-group-flush">

			      		@foreach($subskeleton as $skeleton)
				    		<li class="list-group-item">{{ $skeleton }} <a href="{{ route('newTemplate', ['type' => 'html','name' => $name, 'skeleton' => $skeleton]) }}" class="btn btn-primary float-right">Create
				  </a></li>
				    	@endforeach

				  	</ul>
			      </div>
			    </div>
			  </div>
			</div>
			  @endforeach
		</div>

		<br>
		<h3>Markdown Skeletons</h3>

		<hr>

		<div class="row">
		   @foreach( $skeletons->get('markdown') as $name => $subskeletont )
			 <div class="col-sm-6">
			  <div class="card">
			    <div class="card-body">
			      <h5 class="card-title">{{ ucfirst($name) }}</h5>
			      <div class="card-text">
			      	<ul class="list-group list-group-flush">

			      		@foreach($subskeletont as $skeleton)
				    		<li class="list-group-item">{{ $skeleton }} <a href="{{ route('newTemplate', ['type' => 'markdown','name' => $name, 'skeleton' => $skeleton]) }}" class="btn btn-primary float-right">Create
				  </a></li>
				    	@endforeach

				  	</ul>
			      </div>
			    </div>
			  </div>
			 </div>
			 @endforeach
		</div>

		<h3 class="mt-4">Templates</h3>

		<hr>

			<div class="row">
				@foreach( $templates->all() as $template )
				<div class="col-sm-6">
					<div class="card">
					    <div class="card-body">
					      <h5 class="card-title">{{ $template->template_name }}</h5>
					      <p class="card-text">{!! $template->template_description == '' ? '<i>No Description</i>' : $template->template_description !!}</p>
					      <a href="{{ route('viewTemplate', [ 'templatename' => $template->template_slug ]) }}" class="btn btn-primary">Edit
						  </a>
					    </div>
					</div>
				</div>

		  @endforeach
		  	
			</div>

	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</body>
</html>