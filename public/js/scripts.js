$(document).ready(function(){

});

// Go to link when clickable table row is clicked
$('.clickable-row').on('click', function(){
    window.location = $(this).data('href');
});

// Print button
$('.print-button').on('click', function(){
    window.print();
    return false;
});

// Confirm deleting item
$('.delete-item').on('click', function(e){
    var item = $(this).attr('name');
    if(!confirm(' Please confirm deleting this '+item+'.  This cannot be reversed.')){
        e.preventDefault();
    }else{

    }
});