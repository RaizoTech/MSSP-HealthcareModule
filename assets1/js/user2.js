$(document).ready(function(){
	var intervalRef;
	//$('html').attr('data-color-theme', 'dark');
	OverlaysOuts();
	SidebarButtons();
	// AJAX Functions HTTP Request PHP Request Tables Everything Here
	var employee_table = $('#employees-list').DataTable({
		ajax: {
			url: 'php_/employees_list.php',
			dataSrc: 'data'
		},
		columns: [
			{
				data: null,
				render: function(data, type, row){
					return '<div class="container gy-3"><img src="assets1/images/employeeimages/'+data.img_url+'" class="w-32px h-32px rounded-pill" alt>'+' '+data.first_name+' '+data.last_name+'</div>';
				}
			},
			{ data: 'department' },
			{ data: 'position' },
			{
				data: null,
				render: function(data, type, row){
					return '<center>'+data.work_type+'</center>';
				}
			},
			{
				data: null,
				render: function(data, type, row){
					return '<center><button type="button" class="btn btn-primary" data-idemp="'+data.employee_id+'" data-bs-toggle="modal" data-bs-target="#employee-info-stat">View</button></center>';
				}
			}
		],
		initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
	});
	function updateEmployeesTable(){
		employee_table.ajax.reload(null, false);
	}
	setInterval(updateEmployeesTable, 1000);
	setInterval(fetchPostArticles, 1000);
	//var onboarding_table = $('#').DataTable({
		//ajax: {},
		//columns: [],
		//initComplete: function(settings, json) {
            //console.log(json); // Log the JSON response to the console
        //}
	//});
	//var offboarding_table = $('#').DataTable({
		//ajax: {},
		//columns: [],
		//initComplete: function(settings, json) {
            //console.log(json); // Log the JSON response to the console
        //}
	//});
	// (/AJAX)
	$('#employee-info-stat').on('show.bs.modal', function(event){
		var idemp = $(event.relatedTarget).data('idemp');
		employeeModalStatistics(idemp);
		fetchAndPopulateTable(idemp);
		startUpdatingEmployeeData(idemp);
	});
	// Function to handle modal hide event
	$('#employee-info-stat').on('hide.bs.modal', function(event) {
    	// Stop updating data when modal is hidden
    	stopUpdatingEmployeeData();
	});
	// Function to start updating employee data
	function startUpdatingEmployeeData(id) {
    	intervalRef = setInterval(function() {
        	employeeModalStatistics(id);
    	}, 1000);
	}
	// Function to stop updating employee data
	function stopUpdatingEmployeeData() {
    	clearInterval(intervalRef);
	}
});
var notificationShown = false;
// External Functions Viewing Functionalities
// Fetch Employee Statistics
// Flag to track if notification has been shown


function employeeModalStatistics(id){
    var data_request = {emp_id: id};
    $.ajax({
        url: 'php_/request_emp.php',
        method: 'POST',
        data: data_request,
        success: function(response){
            // Parse JSON response
            var responseData = JSON.parse(response);
            if (responseData.data.length > 0) {
                // Check if notification has been shown
                if (!notificationShown) {
                    // Set Variables Again
                    var message_result = "Employee data loaded!";
                    new Noty({
                        text: message_result,
                        type: 'success'
                    }).show();
                    // Set flag to true
                    notificationShown = true;
                }
                // Data Parsing and logic fetching
                displayEmployeeData(responseData.data[0]);
                // Set interval only if not already set
                if (!intervalRef) {
                    intervalRef = setInterval(function() {
                        displayEmployeeData(responseData.data[0]);
                    }, 1000);
                }
            } else {
                // Handle case when no data is found
                if (!notificationShown) {
                    var message_result = "No employee data found for this ID.";
                    new Noty({
                        text: message_result,
                        type: 'error'
                    }).show();
                    // Set flag to true
                    notificationShown = true;
                }
            }
        }
    });
}

// Calculated Age
function calculateAge(birthday) {
    var ageDate = new Date(Date.now() - birthday.getTime());
    var age = Math.abs(ageDate.getUTCFullYear() - 1970);
    return age;
}
// Function to fetch and populate table data
function fetchAndPopulateTable(emp_id) {
    $.ajax({
        url: 'php/activity_logs_eism.php',
        method: 'POST',
        dataType: 'json',
        data: { emp_id: emp_id }, // Pass the employee ID to the server
        success: function(data) {
            console.log("JSON Data:", data);
            if (data.length > 0) {
                $('#activity-logs-emp-eism').css('display','block'); // Show the table
                $('#no-activity-message').css('display','none'); // Hide the message
                populateTable(data);
            } else {
                $('#activity-logs-emp-eism').css('display','none'); // Hide the table
                $('#no-activity-message').css('display','block'); // Show the message
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
}
// Function to populate the table with data
function populateTable(data) {
    var tableBody = $('#activity-logs-emp-eism tbody');
    tableBody.empty(); // Clear existing table data

    data.forEach(function(log) {
        var row = $('<tr>');
        row.append($('<td>').text(log.datetime));
        row.append($('<td>').html('<center><a href="viewdetailed_logs.php?user=' + log.employee_id + '" target="_blank" class="btn btn-primary">View Details</a></center>'));
        tableBody.append(row);
    });
}

// Example function to display employee data
function displayEmployeeData(employee_column) {
    // Data Parsing and logic fetching
    var eism_dob = new Date(employee_column.dob);
	var age = calculateAge(eism_dob);
	var dob_formatted = eism_dob.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
	// Set of HTML TAGS to show text or data
	$('#emp_image').attr('src', 'assets1/images/employeeimages/'+employee_column.img_url);
    $('#name_eism').text(employee_column.first_name + ' ' + employee_column.middle_name + ' ' + employee_column.last_name);
    $('#dob_eism').text(dob_formatted); // Correctly displaying the date of birth
    $('#age_eism').text(age + ' years old');
    $('#placebirth_eism').text( employee_column.place_birth);
    $('#gender_eism').text(employee_column.gender);
    $('#civil_status_eism').text(employee_column.civil_status);
   	$('#email_eism').text(employee_column.email);
   	$('#department_eism').text(employee_column.department);
   	$('#position_eism').text(employee_column.position);
   	$('#worktype_eism').text(employee_column.work_type);
   	$('#act-name-eism').text('Activity Logs of '+employee_column.first_name+' '+employee_column.last_name);
}
// Fetch Article
function fetchPostArticles(){
    $.ajax({
        url: 'php/fetch_posted_articles.php',
        method: 'POST',
        success: function(response){
            $('#fetch-articles-post').html(response);
        }
    });
}
// Overlay Out Function
function OverlaysOuts(){
	$('#re-egm-p1').css('display','block');
	$('#re-egm-p2').css('display','none');
	$('#re-egm-p3').css('display','none');
	$('#re-egm-p4').css('display','none');
	$('#re-egm-p5').css('display','none');
	$('#re-egm-p6').css('display','none');
}
// Sidebar Functions
function SidebarButtons(){
	$('#re-egm-s1').click( function(){
		$('#re-egm-p1').css('display','block');
		$('#re-egm-p2').css('display','none');
		$('#re-egm-p3').css('display','none');
		$('#re-egm-p4').css('display','none');
		$('#re-egm-p5').css('display','none');
		$('#re-egm-p6').css('display','none');
	});
	$('#re-egm-s2').click( function(){
		$('#re-egm-p1').css('display','none');
		$('#re-egm-p2').css('display','block');
		$('#re-egm-p3').css('display','none');
		$('#re-egm-p4').css('display','none');
		$('#re-egm-p5').css('display','none');
		$('#re-egm-p6').css('display','none');
	});
	$('#re-egm-s3').click( function(){
		$('#re-egm-p1').css('display','none');
		$('#re-egm-p2').css('display','none');
		$('#re-egm-p3').css('display','block');
		$('#re-egm-p4').css('display','none');
		$('#re-egm-p5').css('display','none');
		$('#re-egm-p6').css('display','none');
	});
	$('#re-egm-s4').click( function(){
		$('#re-egm-p1').css('display','none');
		$('#re-egm-p2').css('display','none');
		$('#re-egm-p3').css('display','none');
		$('#re-egm-p4').css('display','block');
		$('#re-egm-p5').css('display','none');
		$('#re-egm-p6').css('display','none');
	});
	$('#re-egm-s5').click( function(){
		$('#re-egm-p1').css('display','none');
		$('#re-egm-p2').css('display','none');
		$('#re-egm-p3').css('display','none');
		$('#re-egm-p4').css('display','none');
		$('#re-egm-p5').css('display','block');
		$('#re-egm-p6').css('display','none');
	});
	$('#re-egm-s6').click( function(){
		$('#re-egm-p1').css('display','none');
		$('#re-egm-p2').css('display','none');
		$('#re-egm-p3').css('display','none');
		$('#re-egm-p4').css('display','none');
		$('#re-egm-p5').css('display','none');
		$('#re-egm-p6').css('display','block');
	});
}