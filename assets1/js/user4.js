$(document).ready(function(){
	// AJAX Functions HTTP Request PHP Request Tables Everything Here
	IntroPanels();
	SidebarButtonsHP();
	//ColorTheme();
	Articles();
	Programs();
	AddArticle();
	AddProgram();
	DeleteArticle();
	// (/AJAX) 
	$('#datepicker1').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    $('#datepicker2').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    // Button click event to show selected date
    $('#datepicker-btn').click(function() {
      var selectedDate = $('#datepicker').datepicker('getDate');
      alert('Selected Date: ' + selectedDate);
    });
	// Modals data-id's
	$('#article-addnew-m').on('show.bs.modal', function(event){
    	// Add new variables and get the datas of data attr's names
    	// End var
    	// fetching the data on input fields or text only
    	// End fetching
    	// Form submission to every update, delete or modify the data
    	// on the database(MYSQL)
    	// End functionalities
    });
    $('#article-viewer-m').on('show.bs.modal', function(event){
    	// Add new variables and get the datas of data attr's names
    	var hwarc_id = $(event.relatedTarget).data('hwid2');
    	var hwarc_title = $(event.relatedTarget).data('hwtitle2');
    	var hwarc_author = $(event.relatedTarget).data('hwauthor2');
    	var hwarc_posted = $(event.relatedTarget).data('hwposted2');
    	var hwarc_image = $(event.relatedTarget).data('hwaimagecontent2');
    	// Set Date
    	// Create a new Date object
		var currentDate = new Date(hwarc_posted);

		// Extract individual components of the date
		var day = currentDate.getDate();
		var month = currentDate.toLocaleString('default', { month: 'long' });
		var year = currentDate.getFullYear();

		// Concatenate components into desired format
		var formattedDate = month + ' ' + day + ', ' + year;
    	// End Set Date
    	// End var
    	// fetching the data on input fields or text only
    	$('#modal-title-viewer').text(hwarc_title);
    	$('#arc-author-v').html('Author: <br><b>'+hwarc_author+'</b>');
    	$('#article-image-v').attr('src','images_article/'+hwarc_image);
    	$('#arc-datepost-v').html('Date Published: <br><b>'+formattedDate+'</b>');
    	ArticleContent(hwarc_id);
    	// End fetching
    	// Form submission to every update, delete or modify the data
    	// on the database(MYSQL)
    	// End functionalities
    });
    // Submission Form
    $('#article-addnew-m').modal('hide').on('hidden.bs.modal', function() {
    	// Reset form or perform any other actions here
    	$('#add-new-article-form')[0].reset(); // Reset the form
    	$('#ckeditor_classic_prefilled').val('');
    	// Other actions you want to perform after the modal is hidden
    });
    $('#program-viewer-m').on('show.bs.modal', function(event){
    	// Add new variables and get the datas of data attr's names
    	var prog_id = $(event.relatedTarget).data('progid2');
    	var prog_name = $(event.relatedTarget).data('progname2');
    	var prog_organizer = $(event.relatedTarget).data('progorg2');
    	var prog_posted = $(event.relatedTarget).data('progposted2');
    	var prog_image = $(event.relatedTarget).data('prognimagecontent2');
    	// Set Date
    	// Create a new Date object
		var currentDate = new Date(prog_posted);

		// Extract individual components of the date
		var day = currentDate.getDate();
		var month = currentDate.toLocaleString('default', { month: 'long' });
		var year = currentDate.getFullYear();

		// Concatenate components into desired format
		var formattedDate = month + ' ' + day + ', ' + year;
    	// End Set Date
    	// End var
    	// fetching the data on input fields or text only
    	$('#modal-title-viewer-prog').text(prog_name);
    	$('#prog-organizer-v').html('Organizer: <br><b>'+prog_organizer+'</b>');
    	$('#prog-image-v').attr('src','images_programs/'+prog_image);
    	$('#prog-datepost-v').html('Date Published: <br><b>'+formattedDate+'</b>');
    	ProgramContent(prog_id);
    	// End fetching
    	// Form submission to every update, delete or modify the data
    	// on the database(MYSQL)
    	// End functionalities
    });
    // Modal for editing properties of selected article
    $('#article-editor-m').on('show.bs.modal', function(event){
        var initID = $(event.relatedTarget).data('hwid1');
        var editTitle = $(event.relatedTarget).data('hwtitle1');
        var editAuthor = $(event.relatedTarget).data('hwauthor1');

        editContent(initID);

        // Pre-fill form fields with existing data
        $('#edit-article-title').val(editTitle);
        $('#edit-article-author').val(editAuthor);
        $('#edit-article-id').val(initID);
    });
    // Hide
    // function retrieve info
    function editContent(arc_id){
        $.ajax({
            url: 'php/article_content_loader.php',
            method: 'POST',
            data: {arc_id: arc_id},
            success: function(response){
                $('#editor1').html(response); // Set CKEditor content
            }
        });
    }
    // For articles search form submission
    $('#search-form-articles').submit(function(event){
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            success: function(response){
                $('#result-here').html(response); // Corrected ID
            }
        });
    });

    // For articles search on keyup
    $('#search-article').keyup(function(){
        var searchQuery = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'php/search_articles.php',
            data: {search_query: searchQuery},
            success: function(response){
                $('#result-here').html(response); // Corrected ID
            }
        });
    });

    // For programs search form submission
    $('#search-form-programs').submit(function(event){
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            success: function(response){
                $('#result-here-programs').html(response); // Corrected ID
            }
        });
    });

    // For programs search on keyup
    $('#search-program').keyup(function(){
        var searchQuery = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'php/search_programs.php',
            data: {search_program: searchQuery},
            success: function(response){
                $('#result-here-programs').html(response); // Corrected ID
            }
        });
    });

    // Tables AJAX
    var table_health_record = $('#health-records-table').DataTable({
    	ajax: {
    		url: 'php/employee_health_record_table.php',
    		dataSrc: 'data'
    	},
    	columns: [
    		{
    			data: null,
    			render: function(data, type, row){
    				return data.first_name+' '+data.last_name;
    			}
    		},
    		{
    			data: null,
    			render: function(data, type, row) {
    				return '<center>'+data.total_checkups+'</center>';
    			}
    		},
    		{
    			data: null,
    			render: function(data, type, row) {
    				return '<center>'+data.total_counselling_appointments+'</center>';
    			}
    		},
    		{
    			data: null,
    			render: function(data, type, row) {
    				return '<center><button type="button" class="btn btn-primary">View Details</button></center>';
    			}
    		}
    	],
    	initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    var table_checkup_appointments = $('#checkup-appointments-table').DataTable({
    	ajax: {
    		url: 'php/checkup_appointments_table.php',
    		dataSrc: 'data'
    	},
    	columns: [
    		{
    			data: null,
    			render: function(data, type, row){
    				return data.first_name+' '+data.last_name;
    			}
    		},
    		{ data: 'medication' },
    		{ 
    			data: 'checkup_date',
    			render: function(data, type, row){
    				var formattedDate = new Date(data).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                	return formattedDate;
    			} 
    		},
    		{
    			data: 'checkup_time',
    			render: function(data, type, row){
    				// Convert timestamp string to Date object
        			var datetime = new Date(data);
        
        			// Format date and time
        			var formattedDateTime = datetime.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        
        			return formattedDateTime;
    			}
    		},
    		{ data: 'checkup_tpye' },
    		{
    			data: null,
    			render: function(data, type, row){
    				return '<center><button type="button" class="btn btn-primary">View Details</button></center>';
    			}
    		}
    	],
    	initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    var table_counselling_appointments = $('#counselling-appointments-table').DataTable({
    	ajax: {
    		url: 'php/counselling_appointments_table.php',
    		dataSrc: 'data'
    	},
    	columns: [
    		{
    			data: null,
    			render: function(data, type, row){
    				return data.first_name+' '+data.last_name;
    			}
    		},
    		{ data: 'service_name' },
    		{
    			data: 'appointment_date',
    			render: function(data, type, row){
    				var formattedDate = new Date(data).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                	return formattedDate;
    			}
    		},
    		{
    			data: 'appointment_time',
    			render: function(data, type, row){
    				// Convert timestamp string to Date object
        			var datetime = new Date(data);
        
        			// Format date and time
        			var formattedDateTime = datetime.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        
        			return formattedDateTime;
    			}
    		},
    		{
    			data: null,
    			render: function(data, type, row){
    				return '<center><button type="button" class="btn btn-primary">View Details</button></center>';
    			}
    		}
    	],
    	initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function updateHealthRecords() {
    	table_health_record.ajax.reload(null, false); // Reload data without resetting current page, sorting, and filtering
    }
    function updateCheckupAppointmentRecords() {
    	table_checkup_appointments.ajax.reload(null, false); // Reload data without resetting current page, sorting, and filtering
    }
    function updateCounsellingAppointmentRecords() {
    	table_counselling_appointments.ajax.reload(null, false); // Reload data without resetting current page, sorting, and filtering
    }
    setInterval(updateHealthRecords, 1000);
    setInterval(updateCheckupAppointmentRecords, 1000);
    setInterval(updateCounsellingAppointmentRecords, 1000);
    UpdateArticle();
    // Update Program
});
// Functions Externals!
function UpdateArticle(){
// Dynamically append a hidden input field to the form


// Intercept form submission
$('#update-selected-article-form').submit(function(event) {
    event.preventDefault(); // Prevent default form submission
    
    // Get form details
    var form = $(this);
    var url = form.attr('action');
    var formData = new FormData(this);
    var editorContent = $('#editor1').html(); // Assuming 'editor1' is the ID of the contenteditable div
    formData.append('new_updated_content', editorContent);
    // AJAX submission
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.result.success1) {
                // Handle success
                showNotificationUpdateArticle1(response.result.message);
                // Hide modal after a delay
                setTimeout(function() {
                    $('#article-editor-m').modal('hide');
                }, 500);
                // Clear form inputs
                $('#editor1').text('');
                $('#edit-article-title').val('');
                $('#edit-article-author').val('');
                $('#updated-profile-image-arc').val('');
                $('#updated-content-image-arc').val('');
            } else {
                // Handle failure
                showNotificationUpdateArticle2(response.result.message, 'error');
                $('#article-editor-m').modal('hide');
            }
        },
        error: function(error) {
            // Handle error
            showNotificationUpdateArticle2('An error occurred. Please try again later.');
            console.log("Error: " + error);
        }
    });
});

// Function to show success notification
function showNotificationUpdateArticle1(message) {
    new Noty({
        text: message,
        type: 'success'
    }).show();
}

// Function to show error notification
function showNotificationUpdateArticle2(message) {
    new Noty({
        text: message,
        type: 'error'
    }).show();
}

}
// Function Add Article
function DeleteArticle(){
	$(document).on('click', '#delete-article', function(event) {
    	var articleId = $(this).data('hwid3');

        new Noty({
            text: 'Are you sure you want to delete this article?',
            type: 'warning',
            buttons: [
                Noty.button('Yes', 'btn btn-success', function() {
                    // User clicked "Yes", proceed with deletion
                    deleteArticle(articleId);
                }, {
                    id: 'btn-yes',
                    'data-status': 'ok'
                }),

                Noty.button('No', 'btn btn-danger ml-2', function() {
                    // User clicked "No", do nothing
                    Noty.closeAll(); // Close the confirmation notification
                })
            ]
        }).show();
	});
	// Function to delete the article
	function deleteArticle(articleId) {
    	$.ajax({
       	 	type: 'POST',
       	 	url: 'php/delete_article.php',
       	 	data: { article_id: articleId },
       	 	success: function(response) {
            	if (response.result.success) {
                	showSuccessNotification11('Article deleted successfully.');
                	Articles();
            	} else {
                	showErrorNotification11('Failed to delete article.');
            	}
       	 	},
        	error: function(xhr, status, error) {
            	showErrorNotification11('An error occurred while deleting the article. Please try again later.');
            	console.error(xhr.responseText);
        	}
    	});
	}
	// Function to show success notification
	function showSuccessNotification11(message) {
    	new Noty({
        	text: message,
        	type: 'success'
    	}).show();
	}
	// Function to show error notification
	function showErrorNotification11(message) {
    	new Noty({
        	text: message,
        	type: 'error'
    	}).show();
	}
}
// Delete function
function AddArticle(){
	// Function to show success notification

// Use event delegation to bind the submit event handler
	$(document).on('submit', '#add-new-article-form', function(event) {
    event.preventDefault();
    
    // Init Form
    var form = $(this);
    var url = form.attr('action');
    var formData = new FormData(this);
    
    // Set AJAX
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.result.success) {
                showNotification1(response.result.message);
                // Delay hiding the modal by 500 milliseconds (adjust as needed)
                setTimeout(function() {
                    $('#article-addnew-m').modal('hide');
                }, 500);
                Articles();
            } else {
                showNotification2(response.result.message, 'error');
                // No delay for showing error notification
                $('#article-addnew-m').modal('hide');
            }
        },
        error: function(error) {
            showNotification('An error occurred. Please try again later.');
            console.log("Error: " + error);
        }
    });
	});

 	// Function to show success notification
    function showNotification1(message) {
        new Noty({
            text: message,
            type: 'success'
        }).show();
    }

    // Function to show error notification
    function showNotification2(message) {
        new Noty({
            text: message,
            type: 'error'
        }).show();
    }

}

function AddProgram(){
	$('#add-new-program-form').append($('<input>', {
		type: 'hidden',
		name: 'new_program_content',
		id: 'new-program-content'
	}));
	$('#add-new-program-form').submit( function(event){
		event.preventDefault();
		// Init Form
    	var form = $(this);
    	var url = form.attr('action');
    	var formData = new FormData(this);

    	var program_content = $('#editor').html();

    	// Append the content to the form data
        $('#new-program-content').val(program_content);

		// Set AJAX
    	$.ajax({	
        	type: 'POST',
        	url: url,
        	data: formData,
        	processData: false,
        	contentType: false,
        	success: function(response) {
            	if (response.result.success) {
                	showNotification1(response.result.message);
                	// Delay hiding the modal by 500 milliseconds (adjust as needed)
                	Programs();
                	setTimeout(function() {
                    	$('#program-addnew-m').modal('hide');
                	}, 500);
                	
                	$('#ckeditor_classic_prefilled').val('');
                	$('#program-name').val('');
                	$('#program-organizer').val('');
                	$('#datepicker1').val('');
                	$('#datepicker2').val('');
                	$('#file-input1prog').val('');
                	$('#file-input2prog').val('');
            	} else {
                	showNotification2(response.result.message, 'error');
                	// No delay for showing error notification
                	$('#program-addnew-m').modal('hide');
            	}
        	},
        	error: function(error) {
            	showNotification2('An error occurred. Please try again later.');
            	console.log("Error: " + error);
        	}
    	});
	});

 	// Function to show success notification
    function showNotification1(message) {
        new Noty({
            text: message,
            type: 'success'
        }).show();
    }

    // Function to show error notification
    function showNotification2(message) {
        new Noty({
            text: message,
            type: 'error'
        }).show();
    }
}
// Delete Article SweetAlertFunction

// Call Article Content
function ArticleContent(arc_id) {
	$.ajax({
		url: 'php/article_content_loader.php',
		method: 'POST',
		data: {arc_id: arc_id},
		success: function(response){
			$('#arc-content-v').html(response);
		}
	});
}
// Call Article Content
function ProgramContent(prog_id) {
	$.ajax({
		url: 'php/program_content_loader.php',
		method: 'POST',
		data: {prog_id: prog_id},
		success: function(response){
			$('#prog-content-v').html(response);
		}
	});
}
// Format Fetch Articles
function Articles(){
	$.ajax({
		type: 'POST',
		url: 'php/fetch_articles.php',
		success: function(response){
			$('#result-here').html(response);
		}
	});
}
// Format Fetch Articles
function Programs(){
	$.ajax({
		type: 'POST',
		url: 'php/fetch_programs.php',
		success: function(response){
			$('#result-here-programs').html(response);
		}
	});
}
function ColorTheme(){
	//const currentTheme = $('html').attr('data-color-theme');
    //const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    $('html').attr('data-color-theme', 'dark');
}
// Intro Panels 
function IntroPanels(){
	$('#health-pr-panel1').css('display','block');
	$('#health-pr-panel2').css('display','none');
	$('#health-pr-panel3').css('display','none');
	$('#health-pr-panel4').css('display','none');
	$('#health-pr-panel5').css('display','none');
	$('#health-pr-panel6').css('display','none');
	$('#health-pr-panel7').css('display','none');
}
//
function SidebarButtonsHP() {
	$('#health-pr-sb1').click( function(event){
		event.preventDefault();
		$('#health-pr-panel1').css('display','block');
		$('#health-pr-panel2').css('display','none');
		$('#health-pr-panel3').css('display','none');
		$('#health-pr-panel4').css('display','none');
		$('#health-pr-panel5').css('display','none');
		$('#health-pr-panel6').css('display','none');
		$('#health-pr-panel7').css('display','none');
	});
	$('#health-pr-sb2').click( function(event){
		event.preventDefault();
		$('#health-pr-panel1').css('display','none');
		$('#health-pr-panel2').css('display','block');
		$('#health-pr-panel3').css('display','none');
		$('#health-pr-panel4').css('display','none');
		$('#health-pr-panel5').css('display','none');
		$('#health-pr-panel6').css('display','none');
		$('#health-pr-panel7').css('display','none');
	});
	$('#health-pr-sb3').click( function(event){
		event.preventDefault();
		$('#health-pr-panel1').css('display','none');
		$('#health-pr-panel2').css('display','none');
		$('#health-pr-panel3').css('display','block');
		$('#health-pr-panel4').css('display','none');
		$('#health-pr-panel5').css('display','none');
		$('#health-pr-panel6').css('display','none');
		$('#health-pr-panel7').css('display','none');
	});
	$('#health-pr-sb4').click( function(event){
		event.preventDefault();
		$('#health-pr-panel1').css('display','none');
		$('#health-pr-panel2').css('display','none');
		$('#health-pr-panel3').css('display','none');
		$('#health-pr-panel4').css('display','block');
		$('#health-pr-panel5').css('display','none');
		$('#health-pr-panel6').css('display','none');
		$('#health-pr-panel7').css('display','none');
	});
	$('#health-pr-sb5').click( function(event){
		event.preventDefault();
		$('#health-pr-panel1').css('display','none');
		$('#health-pr-panel2').css('display','none');
		$('#health-pr-panel3').css('display','none');
		$('#health-pr-panel4').css('display','none');
		$('#health-pr-panel5').css('display','block');
		$('#health-pr-panel6').css('display','none');
		$('#health-pr-panel7').css('display','none');
	});
	$('#health-pr-sb6').click( function(event){
		event.preventDefault();
		$('#health-pr-panel1').css('display','none');
		$('#health-pr-panel2').css('display','none');
		$('#health-pr-panel3').css('display','none');
		$('#health-pr-panel4').css('display','none');
		$('#health-pr-panel5').css('display','none');
		$('#health-pr-panel6').css('display','block');
		$('#health-pr-panel7').css('display','none');
	});
	$('#health-pr-sb7').click( function(event){
		event.preventDefault();
		$('#health-pr-panel1').css('display','none');
		$('#health-pr-panel2').css('display','none');
		$('#health-pr-panel3').css('display','none');
		$('#health-pr-panel4').css('display','none');
		$('#health-pr-panel5').css('display','none');
		$('#health-pr-panel6').css('display','none');
		$('#health-pr-panel7').css('display','block');
	});
}