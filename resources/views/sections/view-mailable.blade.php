@extends('maileclipse::layout.app')

@section('title', 'View Mailable')

@section('content')

<!-- <span class="badge font-weight-light badge-secondary">
                GET
     </span> -->

     {{-- {{ dd($templates->all()) }} --}}


     {{-- {{ dd($resource) }} --}}

     {{-- {{ dd(collect($resource['data']->from)->first()['address']) }} --}}



<div class="col-lg-10 col-md-12">

	<nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('mailableList') }}">Mailables</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $resource['name'] }}</li>
      </ol>
    </nav>
                <!-- <div class="card my-4">
                    <div class="card-header d-flex align-items-center justify-content-between"><h5>Settings</h5>
                    </div>
                    <div class="card-body card-bg-secondary">
                        <form action="">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-lg-2 col-md-12 col-form-label">Text</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-search-input" class="col-lg-2 col-md-12 col-form-label">Search</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-email-input" class="col-lg-2 col-md-12 col-form-label">Email</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-url-input" class="col-lg-2 col-md-12 col-form-label">URL</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Save Settings</button>
                        </form>
                    </div>
                </div> -->
                <!-- <div class="card my-4">
                    <pre class="m-0"><code class="language-css">p {color: #000;}</code></pre>
                </div> -->

                <div class="card my-4">
                    <div class="card-header d-flex align-items-center justify-content-between"><h5>Details</h5>
                    </div>
                    <div class="card-body card-bg-secondary">
                        <table class="table mb-0 table-borderless">
                            <tbody>
                                <tr>
                                    <td class="table-fit font-weight-sixhundred">Name</td>
                                    <td>
                                        {{ $resource['name'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-fit font-weight-sixhundred">Namespace</td>
                                    <td>
                                        {{ $resource['namespace'] }}
                                    </td>
                                </tr>

                                @if ( !empty($resource['data']->subject) )
				    				<tr>
	                                    <td class="table-fit font-weight-sixhundred">Subject</td>
	                                    <td>
	                                        {{ $resource['data']->subject }}
	                                    </td>
                                	</tr>
				    			@endif

                                @if ( !empty($resource['data']->locale) )
				    				<tr>
	                                    <td class="table-fit font-weight-sixhundred">Locale</td>
	                                    <td>
	                                        {{ $resource['data']->locale }}
	                                    </td>
                                	</tr>
				    			@endif

				    				<tr>
	                                    <td class="table-fit font-weight-sixhundred">From</td>
	                                    <td><a href="mailto:{{ collect($resource['data']->from)->first()['address'] }}{{ !collect($resource['data']->from)->isEmpty() ? collect($resource['data']->from)->first()['address'] : config('mail.from.address') }}" class="badge badge-info mr-1 font-weight-light">
	                                    	@if (!collect($resource['data']->from)->isEmpty())

                            					{{ collect($resource['data']->from)->first()['address'] }}

                            					@else
											
												{{ config('mail.from.address') }} (default)

                            				@endif
                        				</a></td>

	                                    {{-- <td></td> --}}
                                	</tr>

                                	<tr>
	                                    <td class="table-fit font-weight-sixhundred">Reply To</td>
	                                    <td><a href="mailto:{{ collect($resource['data']->replyTo)->first()['address'] }}{{ !collect($resource['data']->replyTo)->isEmpty() ? collect($resource['data']->replyTo)->first()['address'] : config('mail.reply_to.address') }}" class="badge badge-info mr-1 font-weight-light">
	                                    	@if (!collect($resource['data']->replyTo)->isEmpty())

                            					{{ collect($resource['data']->replyTo)->first()['address'] }}

                            					@else
											
												{{ config('mail.reply_to.address') }} (default)

                            				@endif
                        				</a></td>

	                                    {{-- <td></td> --}}
                                	</tr>

                                @if ( !empty($resource['data']->cc) )
                                <tr>
                                    <td class="table-fit font-weight-sixhundred">cc</td>
                                    <td>
                                    	@foreach( $resource['data']->cc as $cc )
                                        <a href="mailto:{{ $cc['address'] }}" class="badge badge-info mr-1 font-weight-light">{{ $cc['address'] }}</a>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                @if ( !empty($resource['data']->bcc) )
                                <tr>
                                    <td class="table-fit font-weight-sixhundred">bcc</td>
                                    <td>
                                    	@foreach( $resource['data']->bcc as $bcc )
                                        {{-- {{ collect($resource['data']->cc)->implode('address', ', ') }} --}}
                                        <a href="mailto:{{ $bcc['address'] }}" class="badge badge-info mr-1 font-weight-light">{{ $bcc['address'] }}</a>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header d-flex align-items-center justify-content-between"><h5>Preview</h5>
                    	@if ( !is_null($resource['view_path']) )
                    		<a class="btn btn-primary" href="{{ route('editMailable', ['name' => $resource['name']]) }}">Edit Template</a>
                    	@endif
                    	
                    </div>
                    <div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive-item" src="{{ route('previewMailable', [ 'name' => $resource['name'] ]) }}" allowfullscreen></iframe>
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
            </div>

<script type="text/javascript">

                
</script>
   
@endsection