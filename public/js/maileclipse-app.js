$(document).ready(function(){

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
});

axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

const el = document.querySelector('img');
    const observer = lozad(el); // passing a `NodeList` (e.g. `document.querySelectorAll()`) is also valid
    observer.observe();


$(function () {
    $('[data-toggle="popover"]').popover();
    $('[maileclipse-data-toggle="tooltip"]').tooltip();
})

$(document).on('click', function (e) {
    $('[data-toggle="popover"],[data-original-title]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {                
            (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
        }

    });
});

});