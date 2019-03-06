<!doctype html>
<html lang="en">

<head>
    <title>MailEclipse - @yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom built theme - This already includes Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('vendor/maileclipse/css/maileclipse-app.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
    <!-- Bootstrap & jquery & lodash & popper & lozad -->
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <!-- Notie Library -->
    <script src="https://unpkg.com/notie"></script>
    <!-- Axios Library -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @if ( request()->route()->getName() === 'newTemplate' ||
          request()->route()->getName() === 'editMailable' || 
          request()->route()->getName() === 'viewTemplate')
<!-- Editor Markdown/Html/Text -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.0/tinymce.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/xml/xml.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/css/css.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/javascript/javascript.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/htmlmixed/htmlmixed.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/display/placeholder.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    @endif

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('vendor/maileclipse/js/maileclipse-app.js') }}"></script>

</head>

<body>

    @include('maileclipse::layout.header')
        
    <div class="container mt-5">
        <div class="row">
            <!-- <div class="col-12 d-block d-sm-none mb-5">
                <div class="pos-f-t">
                    <div class="collapse" id="navbarToggleExternalContent">
                        <div class="bg-light p-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item active">Mailables</li>
                                <li class="list-group-item">Templates</li>
                            </ul>
                        </div>
                    </div>
                    <nav class="navbar navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                </div>
            </div> -->

            {{-- {{ dd( request()->route()->getName() === 'newTemplate') }} --}}

            @if ( request()->route()->getName() !== 'newTemplate' && 
                  request()->route()->getName() !== 'editMailable' &&
                  request()->route()->getName() !== 'viewTemplate'
                )

                @include('maileclipse::layout.sidebar')

            @endif

            @yield('content')
            
        <!-- <div class="alert alert-success" role="alert">
            A simple success alert—check it out!
        </div> -->

        </div>
        @include('maileclipse::layout.footer')
    </div>

    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}

<!-- JS here -->

<script type="text/javascript">
/*const el = document.querySelector('img');
const observer = lozad(el); // passing a `NodeList` (e.g. `document.querySelectorAll()`) is also valid
observer.observe();

$(function () {
    $('[data-toggle="popover"]').popover();
})

$(document).on('click', function (e) {
    $('[data-toggle="popover"],[data-original-title]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {                
            (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
        }

    });
});*/
</script>

</body>

</html>