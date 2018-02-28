$(document).ready(function(){

});

// Go to link when clickable table row is clicked
$('.clickable-row').on('click', function(){
    window.location = $(this).data('href');
});