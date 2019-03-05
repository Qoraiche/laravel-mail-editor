@extends('maileclipse::layout.app')

@section('title', 'Templates')

@section('content')

<!-- <span class="badge font-weight-light badge-secondary">
                GET
     </span> -->

     {{-- {{ dd($templates->all()) }} --}}

<div class="col-lg-10 col-md-12">
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
                    <div class="card-header d-flex align-items-center justify-content-between"><h5>{{ __('Templates') }}</h5> {{-- <input type="text" id="searchInput" placeholder="Search Tag" class="form-control w-25"> --}}
                        @if (!$templates->isEmpty())
                        <a href="{{ route('selectNewTemplate') }}" class="btn btn-primary">{{ __('Add Template') }}</a>
                        @endif
                    </div>

                    @if ($templates->isEmpty())
                    
                    @component('maileclipse::layout.emptydata')
                        
                        <span class="mt-4">{{ __("We didn't find anything - just empty space.") }}</span>
                        <a class="btn btn-primary mt-3" href="{{ route('selectNewTemplate') }}">{{ __('Add New Template') }}</a>

                    @endcomponent

                    @endif

                    @if (!$templates->isEmpty())
                    <!---->
                    <table id="templates_list" class="table table-responsive table-hover table-sm mb-0 penultimate-column-right">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Description') }}</th>
                                <th scope="col">{{ __('Template') }}</th>
                                <th scope="col">{{ __('') }}</th>
                                <th scope="col" class="text-center">{{ __('Type') }}</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($templates->all() as $template)
                            <tr id="template_item_{{ $template->template_slug }}">
                                <td class="pr-0">{{ ucwords($template->template_name) }}</td>
                                <td class="text-muted" title="/tee">{{ $template->template_description }}</td>

                                <td class="table-fit"><span>{{ ucfirst($template->template_view_name) }}</td>


                                <td class="table-fit text-muted"><span>{{ ucfirst($template->template_skeleton) }}</td>

                                <td class="table-fit text-center"><span>{{ ucfirst($template->template_type) }}</td>

                                <td class="table-fit">
                                    <a href="{{ route('viewTemplate', [ 'templatename' => $template->template_slug ]) }}" class="table-action mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 16"><path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
                                    </a>
                                    <a href="#" class="table-action remove-item" data-template-slug="{{ $template->template_slug }}" data-template-name="{{ $template->template_name }}">
                                    <svg enable-background="new 0 0 268.476 268.476" version="1.1" viewBox="0 0 268.476 268.476" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" class="remove">
    <path d="m63.119 250.25s3.999 18.222 24.583 18.222h93.072c20.583 0 24.582-18.222 24.582-18.222l18.374-178.66h-178.98l18.373 178.66zm106.92-151.81c0-4.943 4.006-8.949 8.949-8.949s8.95 4.006 8.95 8.949l-8.95 134.24c0 4.943-4.007 8.949-8.949 8.949s-8.949-4.007-8.949-8.949l8.949-134.24zm-44.746 0c0-4.943 4.007-8.949 8.949-8.949 4.943 0 8.949 4.006 8.949 8.949v134.24c0 4.943-4.006 8.949-8.949 8.949s-8.949-4.007-8.949-8.949v-134.24zm-35.797-8.95c4.943 0 8.949 4.006 8.949 8.949l8.95 134.24c0 4.943-4.007 8.949-8.95 8.949-4.942 0-8.949-4.007-8.949-8.949l-8.949-134.24c0-4.943 4.007-8.95 8.949-8.95zm128.87-53.681h-39.376v-17.912c0-13.577-4.391-17.899-17.898-17.899h-53.696c-12.389 0-17.898 6.001-17.898 17.899v17.913h-39.376c-7.914 0-14.319 6.007-14.319 13.43 0 7.424 6.405 13.431 14.319 13.431h168.24c7.914 0 14.319-6.007 14.319-13.431 0-7.423-6.405-13.431-14.319-13.431zm-57.274 0h-53.695l1e-3 -17.913h53.695v17.913z" clip-rule="evenodd" fill-rule="evenodd"></path>
</svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                    <!---->
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

<script type="text/javascript">

    $('.remove-item').click(function(){
        var templateSlug = $(this).data('template-slug');
        var templateName = $(this).data('template-name');

    notie.confirm({

        text: 'Are you sure you want to do that?<br>Delete Template <b>'+ templateName +'</b>',

    submitCallback: function () {

    axios.post('{{ route('deleteTemplate') }}', {
        templateslug: templateSlug,
    })
    .then(function (response) {

        if (response.data.status == 'ok'){
            notie.alert({ type: 1, text: 'Template deleted', time: 2 });

            jQuery('tr#template_item_' + templateSlug).fadeOut('slow');

            var tbody = $("#templates_list tbody");

            console.log(tbody.children().length);

            if (tbody.children().length <= 1) {
                location.reload();
            }

        } else {
            notie.alert({ type: 'error', text: 'Template not deleted', time: 2 })
        }
    })
    .catch(function (error) {
        notie.alert({ type: 'error', text: error, time: 2 })
    });

  }
})

    });


                
</script>
   
@endsection