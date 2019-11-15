@extends('maileclipse::layout.app')

@section('title', 'View Mailable')

@section('content')

<div class="col-lg-10 col-md-12">

	<nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('mailableList') }}">Mailables</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $resource['name'] }}</li>
      </ol>
    </nav>
             
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
	                                    <td><a href="mailto:{{ !collect($resource['data']->from)->isEmpty() ? collect($resource['data']->from)->first()['address'] : config('mail.from.address') }}" class="badge badge-info mr-1 font-weight-light">
	                                    	@if (!collect($resource['data']->from)->isEmpty())

                            					{{ collect($resource['data']->from)->first()['address'] }}

                            					@else
											
												{{ config('mail.from.address') }} (default)

                            				@endif
                        				</a></td>
                                	</tr>

                                	<tr>
	                                    <td class="table-fit font-weight-sixhundred">Reply To</td>
	                                    <td><a href="mailto:{{ !collect($resource['data']->replyTo)->isEmpty() ? collect($resource['data']->replyTo)->first()['address'] : config('mail.reply_to.address') }}" class="badge badge-info mr-1 font-weight-light">
	                                    	@if (!collect($resource['data']->replyTo)->isEmpty())

                            					{{ collect($resource['data']->replyTo)->first()['address'] }}

                            					@else
											
												{{ config('mail.reply_to.address') }} (default)

                            				@endif
                        				</a></td>

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
            </div>

<script type="text/javascript">

                
</script>
   
@endsection