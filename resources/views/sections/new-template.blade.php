@extends('maileclipse::layout.app')

@section('title', 'New Template')

@section('editor', true)

@section('content')

<!-- <span class="badge font-weight-light badge-secondary">
                GET
     </span> -->

     {{-- {{ dd($skeletons->all()) }} --}}



<div class="col-lg-10 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('templateList') }}">Templates</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Template</li>
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

                <div class="card mb-3">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-html-tab" data-toggle="pill" href="#pills-html" role="tab" aria-controls="pills-html" aria-selected="true">HTML</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-markdown-tab" data-toggle="pill" href="#pills-markdown" role="tab" aria-controls="pills-markdown" aria-selected="false">Markdown</a>
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-html" role="tabpanel" aria-labelledby="pills-html-tab">
                            <div class="card-columns">

@foreach( $skeletons->get('html') as $name => $subskeleton )

<div class="card">
<!-- <img class="card-img-top" src="https://1rj8i398ld62y6ih02fyvv4k-wpengine.netdna-ssl.com/wp-content/uploads/2018/12/mantra-welcome.png" alt="Card image cap"> -->
    <div class="content template-item" data-toggle="modal" data-target="#select{{ $name }}Modal">
      <div class="content-overlay"></div>

      @if ( file_exists( public_path("vendor/maileclipse/images/skeletons/html/{$name}.png") ) )

        <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/html/'.$name.'.png' ) }}" alt="{{ $name }}">

      @elseif( file_exists( public_path( "vendor/maileclipse/images/skeletons/html/{$name}.jpg" ) ) )

        <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/html/'.$name.'.jpg' ) }}" alt="{{ $name }}">

      @else

      <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/no-image.png' ) }}" alt="{{ $name }}">

      @endif

      <div class="content-details">
        <h4 class="content-title mb-3">{{ $name }}</h4>
        <!-- <p class="content-text">This is a short description</p> -->
      </div>

</div>
</div>


<!-- Modal -->
@foreach($subskeleton as $skeleton)
    <div class="modal fade" id="select{{ $name }}Modal" tabindex="-1" role="dialog" aria-labelledby="selectTemplateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectTemplateModalLabel">{{ ucfirst($name) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select Template:</p>
                    <div class="list-group list-group-flush">
                        @foreach($subskeleton as $skeleton)
                            <a href="{{ route('newTemplate', ['type' => 'html','name' => $name, 'skeleton' => $skeleton]) }}" class="list-group-item list-group-item-action">{{ $skeleton }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
    <!-- End modal -->

@endforeach

</div>

                        </div>
                        <div class="tab-pane fade" id="pills-markdown" role="tabpanel" aria-labelledby="pills-markdown-tab">
                            <div class="card-columns">
                            <!-- markdown -->
                            @foreach( $skeletons->get('markdown') as $name => $subskeleton )
                                <div class="card">
<!-- <img class="card-img-top" src="https://1rj8i398ld62y6ih02fyvv4k-wpengine.netdna-ssl.com/wp-content/uploads/2018/12/mantra-welcome.png" alt="Card image cap"> -->
    <div class="content template-item" data-toggle="modal" data-target="#{{ $name }}Modal">
      <div class="content-overlay"></div>

      @if ( file_exists( public_path("vendor/maileclipse/images/skeletons/markdown/{$name}.png") ) )

        <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/markdown/'.$name.'.png' ) }}" alt="{{ $name }}">

      @elseif( file_exists( public_path( "vendor/maileclipse/images/skeletons/markdown/{$name}.jpg" ) ) )

        <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/markdown/'.$name.'.jpg' ) }}" alt="{{ $name }}">

      @else

      <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/no-image.png' ) }}" alt="{{ $name }}">

      @endif

      <div class="content-details">
        <h4 class="content-title mb-3">{{ $name }}</h4>
        <!-- <p class="content-text">This is a short description</p> -->
      </div>

</div>
</div>

<!-- Modal -->

    <div class="modal fade" id="{{ $name }}Modal" tabindex="-1" role="dialog" aria-labelledby="selectTemplateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectTemplateModalLabel">{{ ucfirst($name) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select Template:</p>
                    <div class="list-group list-group-flush">
                        @foreach($subskeleton as $skeleton)
                      <a href="{{ route('newTemplate', ['type' => 'markdown','name' => $name, 'skeleton' => $skeleton]) }}" class="list-group-item list-group-item-action">{{ $skeleton }}</a>
                      @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->

                            @endforeach
                        </div>
                    </div>
                    </div>
                </div>
</div>

                <!--- MAILABLE INFO CARD --->
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
   
@endsection