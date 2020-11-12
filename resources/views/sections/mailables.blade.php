@extends('maileclipse::layout.app')

@section('title', 'Mailables')

@section('content')

<div class="col-lg-10 col-md-12">

                <div class="card my-4">
                    <div class="card-header d-flex align-items-center justify-content-between"><h5>{{ __('Mailables') }}</h5>

                        @if (!$mailables->isEmpty())
                            <a class="btn btn-primary" href="#newMailableModal" data-toggle="modal" data-target="#newMailableModal">{{ __('Add Mailable') }}</a>
                        @endif
                        <!-- Modal -->
                    </div>

                    @if ($mailables->isEmpty())

                    @component('maileclipse::layout.emptydata')

                        <span class="mt-4">{{ __("We didn't find anything - just empty space.") }}</span><button class="btn btn-primary mt-3" data-toggle="modal" data-target="#newMailableModal">{{ __('Add New Mailable') }}</button>

                    @endcomponent

                    @endif

                    @if (!$mailables->isEmpty())
                    <!---->
                    <table id="mailables_list" class="table table-responsive table-hover table-sm mb-0 penultimate-column-right">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Namespace') }}</th>
                                <th scope="col">{{ __('Last edited') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($mailables->all() as $mailable)
                            <tr id="mailable_item_{{ $mailable['name'] }}">
                                <td class="pr-0">
                                    {{ $mailable['name'] }}
                                </td>
                                <td class="text-muted" title="/tee">{{ $mailable['namespace'] }} </td>

                                <td class="table-fit"><span>{{ (\Carbon\Carbon::createFromTimeStamp($mailable['modified']))->diffForHumans() }}</span></td>

                                <td class="table-fit">
                                    <a href="{{ route('viewMailable', ['name' => $mailable['name']]) }}" class="table-action mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 16"><path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
                                    </a>

                                    <a href="#" class="table-action remove-item" data-mailable-name="{{ $mailable['name'] }}">
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
                </div>

                <div class="modal fade" id="newMailableModal" tabindex="-1" role="dialog" aria-labelledby="newMailableModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form id="create_mailable" action="{{ route('generateMailable') }}" method="POST">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Mailable</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning new-mailable-alerts d-none" role="alert">

        </div>
          <div class="form-group">
            <label for="mailableName">Name</label>
            <input type="text" class="form-control" id="mailableName" name="name" placeholder="Mailable name" required>
            <small class="form-text text-muted">Enter mailable name e.g <b>Welcome User</b>, <b>WelcomeUser</b></small>
          </div>
          <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" id="markdown--truth" value="option1"> Markdown Template
                <small class="form-text text-muted">Use markdown template</small>
            </label>
        </div>
        <div class="form-group markdown-input" style="display: none;">
            <label for="markdownView">Markdown</label>
            <input type="text" class="form-control" name="markdown" id="markdownView" placeholder="e.g markdown.view">
        </div>

        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" id="forceCreation" name="force"> Force
                <small class="form-text text-muted">Force mailable creation even if already exists</small>
            </label>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create Mailable</button>
      </div>
    </div>
</form>
  </div>
</div>
            </div>

<script type="text/javascript">

    $(document).ready(function(){

        if ($('#markdown--truth').is(':checked')) {

                $('.markdown-input').show();
            } else {

                $('.markdown-input').hide();
            }

        $('#markdown--truth').change(
        function(){
            if ($(this).is(':checked')) {

                $('.markdown-input').show();
            } else {

                $('.markdown-input').hide();
            }
        });

    $('.remove-item').click(function(){
        var mailableName = $(this).data('mailable-name');

    notie.confirm({

        text: 'Are you sure you want to do that?<br>Delete Mailable <b>'+ mailableName +'</b>',

    submitCallback: function () {

    axios.post('{{ route('deleteMailable') }}', {
        mailablename: mailableName,
    })
    .then(function (response) {

        if (response.data.status == 'ok'){

            notie.alert({ type: 1, text: 'Mailable deleted', time: 2 });

            jQuery('tr#mailable_item_' + mailableName).fadeOut('slow');

            var tbody = $("#mailables_list tbody");

            if (tbody.children().length <= 1) {
                location.reload();
            }

        } else {
            notie.alert({ type: 'error', text: 'Mailable not deleted', time: 2 })
        }
    })
    .catch(function (error) {
        notie.alert({ type: 'error', text: error, time: 2 })
    });

  }
})

    });
});

    $('form#create_mailable').on('submit', function(e){
        e.preventDefault();
        // /generateMailable
        // new-mailable-alerts
        //
        //


    if ( $('input#markdown--truth').is(':checked') && $('#markdownView').val() == '')
    {

        // console.log('yes');
        $('#markdownView').addClass('is-invalid');
        return;
    }


        axios.post( $(this).attr('action'), $(this).serialize() )

        .then(function (response) {
            if (response.data.status == 'ok')
            {
                $('#newMailableModal').modal('toggle');
                notie.alert({ type: 1, text: response.data.message, time: 3 });

                setTimeout(function(){ location.reload(); }, 1000);
            } else {
                $('.new-mailable-alerts').text(response.data.message);
                $('.new-mailable-alerts').removeClass('d-none');
            }
        })

    .catch(function (error) {
        notie.alert({ type: 'error', text: error, time: 2 })
    });

    });


</script>

@endsection
