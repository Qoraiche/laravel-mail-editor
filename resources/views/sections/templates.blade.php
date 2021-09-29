@extends('layouts.app')

@section('title', 'Templates')

@section('content')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
<div class="row  m-0">
	<div class="col-lg-12">
        <h2 class="page-heading"> {{ __('Templates') }} <span class="count-text  pull-right">
			<a class="btn btn-secondary"  href="{{ route('mailableList') }}">{{ __('Mailables') }}</a></span>
		</h2>
    </div>

	<div class="col-lg-12">
			<div class="row mb-4">
					<div class="col-md-12">
						<div class="pull-right mt-4">
							<a class="btn btn-secondary" href="#" onclick="showList('templates_list', 'templates_list_created')"> Template list </a>
							<a class="btn btn-secondary" href="#" onclick="showList('templates_list_created', 'templates_list')"> Created list</a>
							<a class="btn btn-secondary"  href="{{ route('selectNewTemplate') }}">
								{{ __('Add Template') }}
							</a>
						</div>
					</div>
			</div> 
			

                    @if ($templates->isEmpty())
                    
                    @component('maileclipse::layout.emptydata')
                        
                    <span class="mt-4">{{ __("We didn't find anything - just empty space.") }}</span>
                    
                        <a class="btn btn-primary mt-3" href="{{ route('selectNewTemplate') }}">{{ __('Add New Template') }}</a>

                    @endcomponent

                    @endif

                    @if (!$templates->isEmpty() || !$templates_dynamic->isEmpty() )
                    
                    <!---->
					 <div class="table-responsive" id="templates_list">
						<table  class="table table-bordered table-striped" style="table-layout: fixed">
                                <thead>
                                    <tr>
                                        <th width='20%'>{{ __('Name') }}</th>
                                        <th  width='20%'>{{ __('Description') }}</th>
                                        <th  width='20%'>{{ __('Template') }}</th>
                        
						<th width='20%'>{{ __('') }}</th>
                                        <th width='10%' class="text-center">{{ __('Type') }}</th>
                                        <th width='10%'></th>
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
                                            <a href="{{ route('viewTemplate', [ 'templatename' => $template->template_slug ]) }}" class="table-action mr-3">
											<i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('attachImages','newsletters') }}?tpl={{ $template->template_slug }}" class="table-action mr-3" data-toggle="Select product"><i class="fa fa-envelope-o"></i></a>
                                            <a href="#" class="table-action remove-item" data-template-slug="{{ $template->template_slug }}" data-template-name="{{ $template->template_name }}">
												<i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
						</div>
						<div class="table-responsive" id="templates_list_created" style="display:none;">
                           <table class="table table-bordered table-striped" style="table-layout: fixed; ">
                                <thead>
                                    <tr>
                                        <th width='20%'>{{ __('Name') }}</th>
                                        <th width='20%'>{{ __('Description') }}</th>
                                        <th width='20%'>{{ __('Template') }}</th>
                                        <th width='20%'>{{ __('') }}</th>
                                        <th width='10%' class="text-center">{{ __('Type') }}</th>
                                        <th width='10%'></th>

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
                                            <a href="{{ route('viewTemplate', [ 'templatename' => $template->template_slug ]) }}" class="table-action mr-3">
												<i class="fa fa-eye"></i>
											</a>
                                            <a href="#" class="table-action remove-item" data-template-slug="{{ $template->template_slug }}" data-template-name="{{ $template->template_name }}">
                                            <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        
                    @endif
                    <!---->
                
    </div>
</div>
<script src="https://unpkg.com/notie"></script>
<script type="text/javascript">
function showList (listIdToShow, listIdToHide) { 
	$('#'+listIdToShow).show();
	$('#'+listIdToHide).hide();
}

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