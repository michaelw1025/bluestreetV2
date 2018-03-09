$(document).ready(function(){
    // attach datepicker
    $(document).on('focus', '.date-pick', function(){
        var inputID = $(this).attr('id');
        $(this).datepicker({
            altField: '.'+inputID,
            altFormat: 'yy-mm-dd',
        });
    });
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




// ----------------SSN validation----------------
// trap keypress - only allow numbers
$('.ssn-format').on('keypress', function(event){
    // trap keypress
    var character = String.fromCharCode(event.which);
    if(!isInteger(character)){
        return false;
    }    
});

// checks that an input string is an integer, with an optional +/- sign character
function isInteger (s) {
    if(s === '-') return true;
   var isInteger_re     = /^\s*(\+|-)?\d+\s*$/;
   return String(s).search (isInteger_re) != -1
}

// format SSN 
$('.ssn-format').on('keyup', function(){
   var val = this.value.replace(/\D/g, '');
   var newVal = '';
    if(val.length > 4) {
        this.value = val;
    }
    if((val.length > 3) && (val.length < 6)) {
        newVal += val.substr(0, 3) + '-';
        val = val.substr(3);
    }
    if (val.length > 5) {
        newVal += val.substr(0, 3) + '-';
        newVal += val.substr(3, 2) + '-';
        val = val.substr(5);
    }
    newVal += val;
    this.value = newVal;   
});
// ----------------End SSN validation----------------




// ----------------Format SSN for Submission, removes dashes----------------
$('.update-employee').on('click', function(){
    $('.ssn-format').each(function(){
        var oldSSN = $(this).val();
        var newSSN = oldSSN.replace(/-/g, '');
        $(this).val(newSSN);
    })
});
// ----------------End Format SSn for Submission----------------




// ----------------Set datepicker defaults----------------
$.datepicker.setDefaults({
    changeMonth: true,
    changeYear: true,
    yearRange: "1920:2030",
    dateFormat: "mm-dd-yy"
});
// ----------------End datepicker defaults----------------




// ----------------Toggle section----------------
$('.toggle-section').on('mouseover', function(){
    $(this).addClass('border border-info');
})
$('.toggle-section').on('mouseleave', function(){
    $(this).removeClass('border border-info');
})
$('.toggle-section').on('click', function(){
    var section = $(this).attr('id');
    $(this).toggleClass('alert-info').toggleClass('alert-success');
    $('.'+section).toggleClass('d-none');
})
// ----------------End toggle section----------------