$( document ).ready(function() {
    $("#registrationform").validate();
    

    $("#reset").click(function() {
	  $('#personal_identification').val('');
	  $('#first_name').val('');
	  $('#last_name').val('');
	  $('#title').val('1');
	  $('#gender0').prop('checked', true);
	  $('#citizenship').val('93');
	  $('#comments').val('');
	});
});