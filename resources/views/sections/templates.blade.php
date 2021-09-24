@extends('maileclipse::layout.app')

@section('title', 'Templates')

@section('content')

<div class="col-lg-10 col-md-12">
    @include('partials.flash_messages')
    <div class="card my-4">
        <div class="card-header d-flex align-items-center justify-content-between"><h5>{{ __('Templates') }}</h5>
            @if (!$templates->isEmpty())
            <div class="">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Template list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Created list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-translate-tab" data-toggle="pill" href="#pills-translate" role="tab" aria-controls="pills-profile" aria-selected="false">Translated list</a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('selectNewTemplate') }}" class="btn btn-primary">{{ __('Add Template') }}</a>
            @endif
        </div>

        @if ($templates->isEmpty())
        
        @component('maileclipse::layout.emptydata')
            
        <span class="mt-4">{{ __("We didn't find anything - just empty space.") }}</span>
        
            <a class="btn btn-primary mt-3" href="{{ route('selectNewTemplate') }}">{{ __('Add New Template') }}</a>

        @endcomponent

        @endif

        @if (!$templates->isEmpty() || !$templates_dynamic->isEmpty() )
        
        <!---->
        <div class="tab-content" id="pills-tabContent">
            <div id="pills-home" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-home-tab">
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
                                <a href="{{ route('viewTemplate', [ 'templatename' => $template->template_slug ]) }}" class="table-action mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 16"><path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg></a>
                                <a href="{{ route('attachImages','newsletters') }}?tpl={{ $template->template_slug }}" class="table-action mr-3" data-toggle="Select product"><i class="fas fa-envelope-open-text"></i></a>
                                <a class="table-action mr-3 btn templ_tran" href="#" data-template-slug="{{ $template->template_slug }}" data-toggle="modal" data-target="#translateModel" title="Translate template" ><i class="fa fa-language " aria-hidden="true"></i></a>
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
            </div>

            <div id="pills-profile" class="tab-pane fade" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                    @foreach($templates_dynamic->all() as $template)
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
            </div>

            <div id="pills-translate" class="tab-pane fade" role="tabpanel" aria-labelledby="pills-translate-tab">
                <table id="templates_list" class="table table-responsive table-hover table-sm mb-0 penultimate-column-right">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Description') }}</th>
                            <th scope="col">{{ __('Template') }}</th>
                            <th scope="col">{{ __('') }}</th>
                            <th scope="col" class="text-center">{{ __('Type') }}</th>
                            <th scope="col" class="text-center">Language</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($templates_translate->all() as $template)
                        <tr id="template_item_{{ $template->template_slug }}">
                            <td class="pr-0">{{ ucwords($template->template_name) }}</td>
                            <td class="text-muted" title="/tee">{{ $template->template_description }}</td>
                            <td class="table-fit"><span>{{ ucfirst($template->template_view_name) }}</td>
                            <td class="table-fit text-muted"><span>{{ ucfirst($template->template_skeleton) }}</td>
                            <td class="table-fit text-center"><span>{{ ucfirst($template->template_type) }}</td>
                            <td class="table-fit text-center"><span>{{ $template->template_language ?? null }}</td>
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
            </div>
        </div>
        @endif
        <!---->
    </div>
</div>

<div class="modal fade" id="translateModel" tabindex="-1" role="dialog" aria-labelledby="translateModel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form id="create_mailable" action="{{ route('translateTemplate') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Translate template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning new-mailable-alerts d-none" role="alert"></div>
                <div class="form-group">
                    <label for="mailableName">Select language</label>
                    <select name="language[]" class="form-control select2" id="dropdown" required multiple>
                        <option value="">Select language</option>
                        @foreach ($languages as $item)
                            <option value="{{ $item->locale }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Hold down the control (ctrl) button to select multiple options</small>
                    <input type="hidden" name="template" value="" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Translate</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script type="text/javascript">

    $(document).on('click','.templ_tran', function () {
        event.preventDefault();
        var temp = $(this).data('template-slug');
        console.log( temp );
        $('input[name=template]').val( temp );
    });

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