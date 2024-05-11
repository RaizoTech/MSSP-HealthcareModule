$(document).ready(function(){
	setPanels();
	sidebarfunctions();
	TableAppointments();
	TodaysAppointments();
    setInterval(ScheduleService, 1000);
	$('#submitData').css('display','none');
	// General Declaration
	const swalInit = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-light',
            denyButton: 'btn btn-light',
            input: 'form-control'
        },
        buttonsStyling: false
    });
    AppointmentsTotal();
	AppointmentsFinishedTotal();
    setInterval(AppointmentsTotal, 1000);
    setInterval(AppointmentsFinishedTotal, 1000);
	// Function to add additional field
	function addAdditionalField() {
    	var additionalField = `
        	<div class="additional-field">
            	<div class="row">
                	<div class="col-md-4">
                    	<div class="form-group">
                        	<label for="date">Date:</label>
                        	<input type="date" class="form-control" name="dateset[]">
                    	</div>
                	</div>
                	<div class="col-md-2">
                    	<div class="form-group">
                        	<label for="time">Time AM</label>
                        	<input type="time" class="form-control" name="timeAM[]">
                    	</div>
                	</div>
                	<div class="col-md-2">
                    	<div class="form-group">
                        	<label for="time">Time PM</label>
                        	<input type="time" class="form-control" name="timePM[]">
                    	</div>
                	</div>
                	<div class="col-md-2">
                    	<div class="form-group">
                        	<label for="time">Slot Limit:</label>
                        	<select class="form-select" name="slot[]" aria-label="Default select example">
                            	<option selected>0</option>
                            	<option value="1">1</option>
                            	<option value="2">2</option>
                            	<option value="3">3</option>
                            	<option value="4">4</option>
                            	<option value="5">5</option>
                            	<option value="6">6</option>
                        	</select>
                    	</div>
                	</div>
                	<div class="col-md-2">
                    	<div class="form-group">
                        	<label>Action:</label><br>
                        	<button type="button" class="btn btn-danger remove-field">Remove</button>
                    	</div>
                	</div>
            	</div>
        	</div>
    	`;
    	$("#dynamicFields").append(additionalField);
    	$('#submitData').css('display','block');
	}
	// Add Date Time button click event handler
	$("#addDateTime").click(function(){
    	var maxSchedules = 4; // Change this value to your maximum schedules limit

    	// Calculate the number of currently added additional fields
    	var currentFields = $(".additional-field").length;

    	// Check if the maximum schedules limit is reached
    	if (currentFields >= maxSchedules) {
        	new Noty({
            	type: 'error',
            	text: 'You have reached the maximum number of schedules for this week.',
            	timeout: 3000
        	}).show();
    	} else {
        	// Make an AJAX request to check the number of available slots
        	$.get("php/check_schedule.php", function(response) {
            	if (response.trim() === "error") {
                	new Noty({
                    	type: 'error',
                    	text: 'Error occurred while fetching available slots.',
                    	timeout: 3000
                	}).show();
            	} else {
                	// Parse response to integer
                	var availableSlots = parseInt(response.trim());

                	// Calculate the number of additional fields to add
                	var remainingSlots = maxSchedules - currentFields;
                	var additionalFieldsToShow = Math.min(remainingSlots, availableSlots);

                	// Add additional fields
                	for (var i = 0; i < additionalFieldsToShow; i++) {
                    	addAdditionalField();
                    	$("#addDateTime").prop('disabled', true);
                	}

                	// Display error message if no available slots
                	if (availableSlots === 0) {
                    	new Noty({
                        	type: 'error',
                        	text: 'You have set your schedule to the maximum limit for this week.',
                        	timeout: 3000
                    	}).show();
                    	new Noty({
                        	type: 'info',
                        	text: 'You can change the status, cancel or delete one of your scheduled slots.',
                        	timeout: 3000
                    	}).show();
                	}
            	}
        	});
    	}
	});
	// Remove Field button click event handler
	$(document).on('click', '.remove-field', function() {
    	$(this).closest('.additional-field').remove();
	});
	// Function to delete all added fields
	$("#deleteAllFields").click(function(){
    	$("#dynamicFields").empty(); // Remove all appended fields
    	$('#submitData').css('display','none');
    	$("#addDateTime").prop('disabled', false);
	});
	// Function to handle form submission
	$("#submitData").click(function(){
    	// Check if any field has no value
    	var hasEmptyField = false;
    	$("input[name^='dateset'], input[name^='timeAM'], input[name^='timePM'], select[name^='slot']").each(function() {
        	if ($(this).val() === '') {
            	hasEmptyField = true;
            	return false; // Exit the loop early if any empty field is found
        	}
    	});

    	// If any field is empty, display a warning notification and return
    	if (hasEmptyField) {
        	new Noty({
            	type: 'warning',
            	text: 'Please fill in all fields before submitting.',
            	timeout: 3000 // 3 seconds
        	}).show();
        	return;
    	}
    	submitForm();
	});
	// Modals 
	$('#set-schedule').on('hide.bs.modal', function(){
		$("#addDateTime").prop('disabled', false);
		$("#dynamicFields").empty(); // Remove all appended fields
    	$('#submitData').css('display','none');
	});
	// Delete Schedule
    $(document).on('click', '#btn-delete-sched', function() {
        var sequenceId = $(this).data('seqid2'); // Get sequence ID from data attribute

        // Display SweetAlert2 confirmation dialog
        swalInit.fire({
            title: 'Are you sure?',
            text: "Delete this schedule you select!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            // If user confirms deletion
            if (result.isConfirmed) {
                // Make AJAX request to delete schedule
                $.ajax({
                    type: 'POST',
                    url: 'php/delete_schedule.php', // URL of your PHP script to handle deletion
                    data: { seq_id: sequenceId }, // Pass sequence ID as data
                    success: function(response) {
                        // If deletion is successful
                        if (response === 'Success') {
                            // Show success message
                            swalInit.fire(
                                'Deleted!',
                                'Schedule has been deleted.',
                                'success'
                            );
                        } else {
                            // If deletion fails, show error message
                            showErrorAlert();
                        }
                    }
                });
            }
        });
    });

    // Function to show error alert
    function showErrorAlert() {
        Swal.fire(
            'Error!',
            'Failed to delete schedule.',
            'error'
        );
    }
    // Edit Schedules Modal Fetch Data 
    $('#edit-schedule').on('show.bs.modal', function(event) {
    	var button = $(event.relatedTarget);
    	var sequenceId_edit = button.data('seqid1');
    	var date_set = button.data('dateset');
    	var timeAM = button.data('timeam');
    	var timePM = button.data('timepm');
    	var slot = button.data('slot');
    	// Convert date string to Date object
    	var dateObj = new Date(date_set);
    
    	// Format date as "Month Day, Year"
    	var formattedDate = dateObj.toLocaleDateString('en-US', {
        	month: 'long',
        	day: 'numeric',
        	year: 'numeric'
    	});
    	$('#sequence-id-sched').val(sequenceId_edit);
    	$('#edit-sched-title').text('Edit - ' + formattedDate + ' - Schedule');
    	$('#edit-dateset').val(date_set);
    	$('#edit-timeAM').val(timeAM);
    	$('#edit-timePM').val(timePM);
    	$('#edit-slot').val(slot);
	});
	// submit data below are under of edit-schedule modal
	$('#submitDataSaveSchedule').click(function() {
        var formData = $('#edit-schedule-selected').serialize();
        $.post("php/update_schedule.php", { data: formData }, function(response) {
            if (response.trim() === 'Schedule Updated!') {
                swalInit.fire(
                    'Success!',
                    response,
                    'success'
                );
            } else {
                swalInit.fire(
                    'Error!',
                    'Failed to update schedule.',
                    'error'
                );
            }
            $('#edit-schedule').modal('hide');
        }).fail(function(xhr, status, error) {
            swalInit.fire(
                'Error!',
                'Failed to send request: ' + error,
                'error'
            );
        });
    });
	$('#submitDataCancel').click(function(){
		var formData = $('#edit-schedule-selected').serialize();
		$.post("php/cancel_schedule.php", {data: formData}, function(response){
			if(response === 'Schedule Cancelled!'){
				swalInit.fire(
                    'Schedule Cancelled!',
                    '',
                    'success'
                );
			} else {
				swalInit.fire(
                    'Error!',
                    'Failed to cancel schedule.',
                    'error'
                );	
			}
			$('#edit-schedule').modal('hide');
		}).fail(function(xhr, status, error) {
            swalInit.fire(
                'Error!',
                'Failed to send request: ' + error,
                'error'
            );
        });
	});
	// Modal View
	// Modal View
	$('#counselling-view-modal').on('show.bs.modal', function(event){
		var counselling_id = $(event.relatedTarget).data('idcounse');
		var empl_student = $(event.relatedTarget).data('idemps');
		getEmployeeDetails(empl_student);
		$('#counselling-id').val(counselling_id);
		$('#counselling-id2').val(counselling_id);
		$('#counselling-id3').val(counselling_id);
	});
	$('#counselling-action1').click( function(){
		var formData = $('#setActionCounselling1').serialize();
		$.post("php/set_going_counselling.php", formData, function(response){
			if(response.trim() === 'success'){
				swalInit.fire(
                    'Success!',
                    'Counselling Started!',
                    'success'
                );
                $('#first-action-panel1').css('display','none');
				$('#second-action-panel2').css('display','block');
				$('#note-submission').css('display', 'none');
			}
		});
	});
	$('#counselling-action2').click(function(){
		var formData = $('#setActionCounselling1').serialize();
		$.post("php/set_not_attend.php", formData, function(response){
			if(response.trim() === 'success'){
				swalInit.fire(
                    'Success!',
                    'Set on Not Attend!',
                    'success'
                );
                $('#first-action-panel1').css('display','block');
				$('#second-action-panel2').css('display','none');
				$('#note-submission').css('display', 'none');
				$('#counselling-view-modal').modal('hide');
			}
		});
	});
	$('#counselling-action3').click(function(){
		var formData = $('#setActionCounselling2').serialize();
		$.post("php/set_finished_counselling.php", formData, function(response){
			if(response.trim() === 'success'){
				swalInit.fire(
                    'Success!',
                    'Finished Counselling!',
                    'success'
                );
                $('#first-action-panel1').css('display','none');
				$('#second-action-panel2').css('display','none');
				$('#note-submission').css('display', 'block');
				//$('#counselling-view-modal').modal('hide');
			}
		});
	});
	$('#counselling-action4').click( function(){
		var formData = $('#note-submission-form').serialize();
		$.post("php/submission_note.php", formData, function(response){
			if(response.trim() === 'success'){
				swalInit.fire(
                    'Success!',
                    'Finish Counselling Run!!',
                    'success'
                );
                $('#first-action-panel1').css('display','block');
				$('#second-action-panel2').css('display','none');
				$('#note-submission').css('display', 'none');
				$('#counselling-view-modal').modal('hide');
			}
		});
	});
});

 function AppointmentsTotal(){
    	$.ajax({
    		url: 'php/appointment_total.php',
    		method: 'POST',
    		success: function(response) {
    			$('#total-appointments').text(response);
    		}
    	});
    }
    function AppointmentsFinishedTotal(){
    	$.ajax({
    		url: 'php/appointment_finished.php',
    		method: 'POST',
    		success: function(response) {
    			$('#total-appointments-f').text(response);
    		}
    	});
    }

function getEmployeeDetails(id) {
	$.ajax({
		url: 'php/employee_details.php',
		type: 'POST',
		dataType: 'json',
		data: {employee_code: id},
		success: function(response) {
			if (response && response.data) {
				var employee_data = response.data[0];
				var fullname = employee_data.fullname;
				var dob = employee_data.date_of_birth;
				var birth = new Date(dob);
				// Get the current date
				var currentDate = new Date();
				// Calculate the difference in years
				var age = currentDate.getFullYear() - birth.getFullYear();
				// Check if the birthday hasn't occurred yet this year
				if (currentDate.getMonth() < birth.getMonth() || (currentDate.getMonth() === birth.getMonth() && currentDate.getDate() < birth.getDate())) {
    				age--;
				}
				$('#cad-emp-name').text(fullname);
				$('#cad-emp-position').text(employee_data.position_);
				$('#cad-emp-department').text(employee_data.department);
				$('#cad-emp-age').text(age);
			}
		}
	});
}
// Function to handle form submission
function submitForm() {
	const swalInit = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-light',
            denyButton: 'btn btn-light',
            input: 'form-control'
        },
        buttonsStyling: false
    });
    // If all fields have values, proceed with form submission
    var formData = $("#add-schedule-form").serializeArray();
    $.post("php/set_schedules.php", {data: formData}, function(response){
        // Display Noty notification
        swalInit.fire(
            'New Schedule Set!',
            response,
            'success'
        );
        //new Noty({
            //type: 'success',
            //text: response,
            //timeout: 3000 // 3 seconds
        //}).show();
        $("#set-schedule").modal("hide");
        // Clear form after submission if needed
        $("#add-schedule-form").trigger("reset");
    });
}
// Fetch all Sched
function ScheduleService(){
	$.ajax({
		url: 'php/schedules.php',
		method: 'POST',
		success: function(response){
			$('#schedules-set').html(response);
		}
	});
}
// External Functions
function TableAppointments(){
	var appointments = $('#appointment-table').DataTable({
		ajax: {
			url: 'php/appointment_list.php',
			dataSrc: 'data'
		},
		columns: [
			{ data: 'fullname' },
			{ data: 'department' },
			{ data: 'position_' },
			{
				data: 'appointment_date',
				render: function(data, type, row){
					// Convert timestamp string to Date object
        			var datetime = new Date(data);
        			// Format date and time
        			var formattedDateTime = datetime.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true });
        			return formattedDateTime;
				}
			},
			{
				data: null, 
				render: function(data, type, row){
					return '<button type="button" class="btn btn-primary" data-idemps="'+data.employee_code+'" data-idcounse="'+data.appointment_id+'" data-bs-toggle="modal" data-bs-target="#counselling-view-modal">View</button>';
				}
			}
		],
		initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
	});
	function update_table1() {
		appointments.ajax.reload(null, false);
	}
	setInterval(update_table1, 1000);
}
function TodaysAppointments(){
	var appointments1 = $('#appointment-today-table').DataTable({
		ajax: {
			url: 'php/appointment_today.php',
			dataSrc: 'data'
		},
		columns: [
			{ data: 'fullname' },
			{ data: 'department' },
			{ data: 'position_' },
			{
				data: 'appointment_date',
				render: function(data, type, row){
					// Convert timestamp string to Date object
        			var datetime = new Date(data);
        			// Format date and time
        			var formattedDateTime = datetime.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true });
        			return formattedDateTime;
				}
			},
			{
				data: null, 
				render: function(data, type, row){
					return '<button type="button" class="btn btn-primary">View</button>';
				}
			}
		],
		initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
	});
	function update_table2() {
		appointments1.ajax.reload(null, false);
	}
	setInterval(update_table2, 1000);
}
function sidebarfunctions(){
	$('#mentor-sb1').click( function(){
		$('#mentor-panel1').css('display','block');
		$('#mentor-panel2').css('display','none');
		$('#mentor-panel3').css('display','none');
		$('#account-settings-section').css('display','none');
	});
	$('#mentor-sb2').click( function(){
		$('#mentor-panel1').css('display','none');
		$('#mentor-panel2').css('display','block');
		$('#mentor-panel3').css('display','none');
		$('#account-settings-section').css('display','none');
	});
	$('#mentor-sb3').click( function(){
		$('#mentor-panel1').css('display','none');
		$('#mentor-panel2').css('display','none');
		$('#mentor-panel3').css('display','block');
		$('#account-settings-section').css('display','none');
	});
	$('#account-set-sb').click( function(){
		$('#mentor-panel1').css('display','none');
		$('#mentor-panel2').css('display','none');
		$('#mentor-panel3').css('display','none');
		$('#account-settings-section').css('display','block');
	});
	$('#appointment-subB1').click( function(){
		$('#all-appointments').css('display','block');
		$('#today-appointments').css('display','none');
	});
	$('#appointment-subB2').click( function(){
		$('#all-appointments').css('display','none');
		$('#today-appointments').css('display','block');
	});
}
function setPanels(){
	$('#mentor-panel1').css('display','block');
	$('#mentor-panel2').css('display','none');
	$('#mentor-panel3').css('display','none');
	$('#account-settings-section').css('display','none');
	$('#all-appointments').css('display','block');
	$('#today-appointments').css('display','none');
}