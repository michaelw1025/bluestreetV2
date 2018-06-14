$(document).ready(function(){
    // attach datepicker
    $(document).on('focus', '.date-pick', function(){
        var inputID = $(this).attr('id');
        $(this).datepicker({
            altField: '.'+inputID,
            altFormat: 'yy-mm-dd',
        });
    });

    checkInitialCheckboxState()

    calculateBeneficiaryTotal();
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

// ----------------Toggle adding spouse----------------
// Set toggel color based on initial state of checkbox
function checkInitialCheckboxState()
{
    $('.toggle-add-item').each(function(){
        if($(this).attr('checked')){
            var item = $(this).attr('id');
            $('.'+item+'-div').removeClass('bg-warning text-dark').addClass('bg-success text-white');
            $('.'+item).removeClass('d-none');
            // $('.'+item).removeClass('d-none');
        }
    });
}
// Change item state on checkbox change
$('.toggle-add-item').on('change', function(){
    var item = $(this).attr('id');
    $('.'+item+'-div').toggleClass('bg-success text-white').toggleClass('bg-warning text-dark');
    $('.'+item).each(function(){
        $(this).toggleClass('d-none');
    });
});
// ----------------end toggle adding spouse----------------

// ----------------Phone number validation----------------
// trap keypress - only allow numbers
$('.phone-number-format').on('keypress', function(event){
    // trap keypress
    var character = String.fromCharCode(event.which);
    if(!isInteger(character)){
        return false;
    }
});

// format phone number
$('.phone-number-format').on('keyup', function(){
   var val = this.value.replace(/\D/g, '');
   var newVal = '';
    if(val.length > 4) {
        this.value = val;
    }
    if((val.length > 3) && (val.length < 6)) {
        newVal += val.substr(0, 3) + '-';
        val = val.substr(3);
    }
    if (val.length > 6) {
        newVal += val.substr(0, 3) + '-';
        newVal += val.substr(3, 3) + '-';
        val = val.substr(6);
    }
    newVal += val;
    this.value = newVal;
});
// ----------------End Phone number validation----------------

// ----------------Set primary phone number----------------
$('.phone-number-primary-button').on('click', function(){
    var item = $(this).attr('id');
    if($(this).hasClass('btn-primary')){
        $('.phone-number-primary-button').removeClass('btn-primary').addClass('btn-outline-secondary');
        $('.phone-number-primary-checkbox').prop('checked', false);
    }else{
        $('.phone-number-primary-button').removeClass('btn-primary').addClass('btn-outline-secondary');
        $('.phone-number-primary-checkbox').prop('checked', false);
        $(this).removeClass('btn-outline-secondary').addClass('btn-primary');
        $('.'+item).prop('checked', true);
    }
});
// ----------------End set primary phone number----------------

// ----------------Set primary emergency contact----------------
$('.emergency-contact-primary-button').on('click', function(){
    var item = $(this).attr('id');
    if($(this).hasClass('btn-primary')){
        $('.emergency-contact-primary-button').removeClass('btn-primary').addClass('btn-outline-secondary');
        $('.emergency-contact-primary-checkbox').prop('checked', false);
    }else{
        $('.emergency-contact-primary-button').removeClass('btn-primary').addClass('btn-outline-secondary');
        $('.emergency-contact-primary-checkbox').prop('checked', false);
        $(this).removeClass('btn-outline-secondary').addClass('btn-primary');
        $('.'+item).prop('checked', true);
    }
});
// ----------------End set primary emergency contact----------------

// ----------------Set wage table based on position chosen----------------
$('.position-select').change(function(){
    var item = $(this).find(':selected').attr('id');
    item = item.split('-').pop();
    $('.wage-progression-table').addClass('d-none');
    $('.progression-'+item).removeClass('d-none');
});
// ----------------End set wage table based on position chosen----------------

// ----------------Select columns for alphabetical employee table----------------
$('.alphabetical-column').on('click', function(){
    var column = $(this).attr('id');
    $(this).toggleClass(' btn-outline-primary btn-primary');
    $('.'+column).toggleClass('d-none');
});
// ----------------End select columns for alphabetical employee table----------------

// ----------------Select columns for reviews table----------------
$('.review-column').on('click', function(){
    var column = $(this).attr('id');
    $('.review-column').removeClass('btn-primary').addClass('btn-outline-primary prevent-print');
    $(this).removeClass('btn-outline-primary prevent-print').addClass('btn-primary');
    $('.thirty-day').addClass('d-none');
    $('.sixty-day').addClass('d-none');
    $('.'+column).removeClass('d-none');
});
// ----------------End select columns for reviews table----------------

// ----------------Select columns for reductions table----------------
$('.reduction-column').on('click', function(){
    var column = $(this).attr('id');
    if($(this).hasClass('btn-primary')){
        $(this).removeClass('btn-primary').addClass('btn-outline-primary');
        $('.'+column).addClass('d-none');
    }else{
        $(this).removeClass('btn-outline-primary').addClass('btn-primary');
        $('.'+column).removeClass('d-none');
    }
});
// ----------------End select columns for reductions table----------------

// ----------------Select columns for anniversaries table----------------
$('.anniversary-column').on('click', function(){
    var column = $(this).attr('id');
    $(this).toggleClass('btn-outline-primary btn-primary');
    $('.'+column).toggleClass('d-none');
});
// ----------------end select columns for anniversaries table----------------

// ----------------Clear wage event scale table----------------
$('.clear-wage-event-scale').on('click', function(){
    if(!confirm('Please confirm clearing the wage event scale.')){

    }else{
        $('.wage-event-scale-date').val('');
    }
});
// ----------------End clear wage event scale table----------------

// ----------------File upload look and functionality----------------
function bs_input_file() {
	$(".input-file").before(
		function() {
			if ( ! $(this).prev().hasClass('input-ghost') ) {
				var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
				element.attr("name",$(this).attr("name"));
				element.change(function(){
					element.next(element).find('input').val((element.val()).split('\\').pop());
				});
				$(this).find("button.btn-choose").click(function(){
					element.click();
				});
				$(this).find("button.btn-reset").click(function(){
					element.val(null);
					$(this).parents(".input-file").find('input').val('');
				});
				$(this).find('input').css("cursor","pointer");
				$(this).find('input').mousedown(function() {
					$(this).parents('.input-file').prev().click();
					return false;
				});
				return element;
			}
		}
	);
}
$(function() {
	bs_input_file();
});
// ----------------End file upload look and functionality----------------
