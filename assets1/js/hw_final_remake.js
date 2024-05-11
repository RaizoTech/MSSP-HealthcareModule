$(document).ready(function(){
    // AJAX Functions HTTP Request PHP Request Tables Everything Here
    startingIntro();
    SidebarButtonsHA();
    //ColorTheme();
    Articles();
    Programs();
    AddArticle();
    AddProgram();
    DeleteArticle();
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
    const swalInit = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-light',
            denyButton: 'btn btn-light',
            input: 'form-control'
        },
        buttonsStyling: false
    });
    // (/AJAX) 
    // Dropdown Health Articles
    //$('.drop-sec').click(function(e){
       // e.preventDefault();
        // Get the value and icon source of the clicked dropdown item
        //var value = $(this).find('.fw-semibold').text();
        //var iconSrc = $(this).find('img').attr('src');
        // Update the text and icon of the main dropdown button
        //$('.dropdown-toggle .fw-semibold').text(value);
        //$('.dropdown-toggle img').attr('src', iconSrc);
    //});
    // Modal for Articles on show modals
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
            url: 'php_hw/article_content_loader.php',
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
            url: 'php_hw/search_articles.php',
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
            url: 'php_hw/search_programs.php',
            data: {search_program: searchQuery},
            success: function(response){
                $('#result-here-programs').html(response); // Corrected ID
            }
        });
    });

    // Tables AJAX
    var table_health_record = $('#health-records-table').DataTable({
        ajax: {
            url: 'php_hw/employee_health_record_table.php',
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
                    return '<center>'+data.total_counselling_app+'</center>';
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    var table_checkup_appointments = $('#checkup-appointments-table').DataTable({
        ajax: {
            url: 'php_hw/checkup_appointments_table.php',
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
                data: 'checkup_date',
                render: function(data, type, row){
                    var formattedDate = new Date(data).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                    return '<center>'+formattedDate+'</center>';
                } 
            },
            {
                data: 'checkup_time',
                render: function(data, type, row){
                    const [hours, minutes, seconds] = data.split(':').map(Number);
                    // Create a new JavaScript Date object
                    const jsDate = new Date();
                    jsDate.setHours(hours);
                    jsDate.setMinutes(minutes);
                    jsDate.setSeconds(seconds);

                    // Add 2 hours and 38 minutes
                    jsDate.setHours(jsDate.getHours() + 2);
                    jsDate.setMinutes(jsDate.getMinutes() + 38);

                    // Format the time to 'hh:mm am/pm' format
                    const formattedTime = jsDate.toLocaleString('en-US', {
                        hour: 'numeric',
                        minute: 'numeric',
                        hour12: true
                    });
                    return '<center>'+formattedTime+'</center>';
                }
            },
            { 
                data: 'checkup_type',
                render: function(data, type, row){
                    return '<center>'+data+'</center>';
                }
            },
            {
                data: 'request_from',
                render: function(data, type, row){
                    if (data === 'ESS') {
                        var status_id = row.status;
                        if (status_id === 'Finished') {
                            return `
                            <center>
                                <button type="button" class="btn btn-primary" disabled>Finished</button>
                            </center>
                            `;
                        } else if (status_id === 'Not Attend') {
                            return `
                            <center>
                                <button type="button" class="btn btn-primary" disabled>Not Attend</button>
                            </center>
                            `;
                        } else if (status_id === 'Pending'){
                            return `
                            <center>
                                <button type="button" class="btn btn-primary" 
                                data-idcheckuprec="`+row.checkup_id+`" 
                                data-bs-toggle="modal" 
                                data-bs-target="#checkup-update-record">
                                    <i class="ph ph-eye"></i>
                                </button>
                            </center> 
                            `;
                        }
                    }
                    if (data === 'Manual(Face2Face)') {
                        var status_id = row.status;
                        if (status_id === 'Pending') {
                            return `
                            <center>
                                <button type="button" class="btn btn-primary" 
                                data-idcheckuprec="`+row.checkup_id+`" 
                                data-bs-toggle="modal" 
                                data-bs-target="#checkup-update-record">
                                    <i class="ph ph-eye"></i>
                                </button>
                            </center> 
                            `;
                        }
                        else if (status_id === 'Finished') {
                            return `
                            <center>
                                <button type="button" class="btn btn-primary" disabled>Finished</button>
                            </center>
                            `;
                        }
                        else if (status_id === 'Not Attend') {
                            return `
                            <center>
                                <button type="button" class="btn btn-primary" disabled>Not Attend</button>
                            </center>
                            `;
                        }
                    }
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    var table_counselling_appointments = $('#counselling-appointments-table').DataTable({
        ajax: {
            url: 'php_hw/counselling_appointments_table.php',
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
            { data: 'appointment_time' }
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
    setInterval(OnDatabaseServices, 1000);
    UpdateArticle();
    DropdownServices();
    OnDatabaseServices();
    // Update Program
    // Add Service & Mentor
    $(document).on('submit', '#add-services-form', function(event) {
    // Get content of the editable div
    var editorContent = $('#editor-serviceshit').html();
    // Prevent Default
    event.preventDefault();
    // Form Serialize
    var formData = new FormData(this);
    //
    formData.append('service_description', editorContent);
    // Ajax
    $.ajax({
        url: 'php_/add_services_mentor_credential.php', // Server-side script URL
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response && response.result) {
                var message = response.result[0];
                swalInit.fire(
                    'Success Added!',
                    'Added New Counselling Services & Mentor Credentials',
                    'success'
                );
            } else {
                swalInit.fire(
                    'Success Added!',
                    'Error in: ' + response.result.message,
                    'error'
                );
            }
            $('#add-counselling-services').modal('hide');
            $('#add-services-form')[0].reset();
            $('#editor-serviceshit').html('');
        },
        error: function(xhr, status, error) {
            // Handle error
            $('#add-counselling-services').modal('hide');
            swalInit.fire(
                'Success Added!',
                'Error in: ' + error,
                'error'
            );
        }
    });
});


// New May 12, 2024,

// New
    // Search Input Employees
    $('#searchInput').on('input', function(){
        var query = $(this).val();
        if(query.length >= 3) { // Adjust minimum characters for search
            $.ajax({
                url: 'php_hw/search.php',
                type: 'POST',
                data: {query: query},
                dataType: 'json',
                success: function(response) {
                    displayResults(response);
                }
            });
        }
    });
    // Clear search results when modal is hidden
    $('#manual-checkup').on('hidden.bs.modal', function () {
        $('#searchResults').empty(); // Empty the search results container
        $('#searchInput').val(''); // Clear the search input field
    });
    // Modal Check up Proceed
    $('#checkup-manual-proceed').on('show.bs.modal', function(event){
        var idempsu = $(event.relatedTarget).data('idempsu');
        console.log(idempsu)
        showEmployeeCheckupInfo(idempsu);
    });
    // Form checkup inserting
    $(document).on('submit', '#manual-checkup-form', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'php_hw/add_checkup_appointment.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response === 'success') {
                    swalInit.fire(
                        'Checkup Recorded',
                        'Added New Record',
                        'success'
                    );
                    $('#checkup-manual-proceed').modal('hide');
                    $('#manual-checkup-form').reset();
                }
                else if (response === 'Please fill all forms'){
                    swalInit.fire(
                        'Fill All Input Field!',
                        'Fill All!',
                        'error'
                    );
                }
                else {
                    swalInit.fire(
                        'Error Checkup Not Recorded',
                        'Server Side Error or Back End Functionalities',
                        'error'
                    );
                }
            }
        });
    });
    // Modal Online Request Modify
    $('#checkup-update-record').on('show.bs.modal', function(event) {
        var idrecord = $(event.relatedTarget).data('idcheckuprec');
        $.ajax({
            url: 'php_hw/record_online_information.php',
            type: 'POST',
            dataType: 'json',
            data: {recordid: idrecord},
            success: function(response) {
                if (response && response.data) {
                    var checkuprecord = response.data[0];
                    $('#employee-code-checkup').val(checkuprecord.checkup_id);
                    $('#checkup-modification-fl').text(checkuprecord.fullname);
                    $('#checkup-modification-email').text(checkuprecord.email);
                }
            }
        });
    });
    // update-checkup-record-form
    $(document).on('submit', '#update-checkup-record-form', function(event){
        // Prevent Default
        event.preventDefault();
        // Serialize Form
        var formData = new FormData(this);
        // Set Ajax
        $.ajax({
            url: 'php_hw/update_checkup_record.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response === 'success') {
                    swalInit.fire(
                        'Checkup Record Updated',
                        'Online request appointment updated!',
                        'success'
                    );
                    $('#checkup-update-record').modal('hide');
                }
                else if (response === 'failed') {
                    swalInit.fire(
                        'Error Not Updated',
                        'Something wrong on your server side!',
                        'error'
                    );
                }
                else if (response === 'Fill all forms!') {
                    swalInit.fire(
                        'Fill All Forms',
                        'Fill all forms no leave until all fields are filled!',
                        'warning'
                    );
                }
                else {
                    swalInit.fire(
                        'Something Wrong',
                        response,
                        'info'
                    );
                }
            }
        });
    });

// End May 12, 2024


});

// Resultshit
function showEmployeeCheckupInfo(id) {
    $.ajax({
        url: 'php_hw/employee_checkup_info.php',
        type: 'POST',
        dataType: 'json',
        data: {idemp: id},
        success: function(response) {
            if (response && response.data) {
                var emp_data = response.data[0];
                $('#employee-name-modal').text('Checkup For '+emp_data.fullname);
                $('#emp-code-form-input').val(emp_data.code);
                $('#fullname-emp').text(emp_data.fullname);
                $('#email-emp').text(emp_data.email);
            }
        }
    });
}
// Result
function displayResults(results) {
    var html = '';
    for(var i = 0; i < results.length; i++) {
        html += '<div class="dropdown-item cursor-pointer">';
        html += '<div class="me-3"><img src="assets1/images/demo/users/default-user.jpg" class="w-32px h-32px rounded-pill" alt=""></div>';
        html += '<div class="d-flex flex-column flex-grow-1">';
        html += '<div class="fw-semibold">' + results[i].fullname + '</div>';
        html += '<span class="fs-sm text-muted">' + results[i].email + '</span>';
        html += '</div>';
        html += '<div class="d-inline-flex"><a href="#" class="text-body ms-2" data-idempsu="'+results[i].code+'" data-bs-toggle="modal" data-bs-target="#checkup-manual-proceed"><i class="ph ph-caret-right"></i></a></div>';
        html += '</div>';
    }
    $('#searchResults').html(html);
}
// End New

// Fetch Real Services
function OnDatabaseServices(){
    $.ajax({
        url: 'php_hw/counselling_services.php',
        method: 'POST',
        success: function(response){
            $('#counselling-services-list').html(response);
        }
    });
}
// dROP sERVICES
function DropdownServices(){
    $(document).on('click', '#dropdown-item1', function(event) {
        event.preventDefault();
        var name = $(this).find(".services-name").text();
        var imageSrc = $(this).find("#services-logo").attr("src");
        var serviceId = $(this).data("idservices"); // Get the value of data-idservices attribute
        var encodedContent = $(this).find('#content-services').val();
        // Decode the HTML entities
        var decodedContent = $('<div/>').html(encodedContent).text();

        // Set the decoded HTML content to the desired element
        $('#fetch-content').html(decodedContent);
        //
        $("#companyName").text(name);
        $("#companyImage").attr("src", imageSrc);
        $('#counselling-service-logo-presentation').attr("src", imageSrc);
        //
        $('#employee-appointment-perservices').css('display','block');
        OnServicesAppointmentEmployee(serviceId);
    });
}
// Drop Down Services Category
// Drop Down Services Category
// Drop Down Services Category
function OnServicesAppointmentEmployee(idservices) {
    var data1 = idservices;
    var table_services_employee = $('#employee-appointment-services-table').DataTable();

    // Check if DataTable is already initialized, destroy it if necessary
    if ($.fn.DataTable.isDataTable('#employee-appointment-services-table')) {
        table_services_employee = $('#employee-appointment-services-table').DataTable();
        table_services_employee.destroy();
    }

    table_services_employee = $('#employee-appointment-services-table').DataTable({
        ajax: {
            url: 'php_hw/perservices_appointments.php',
            method: 'POST',
            data: { service_id: data1 },
            dataSrc: 'data1' // Specify the property containing the data array
        },
        columns: [
            {
                data: 'fullname',
                render: function(data, type, row) {
                    return `<h6 class="mb-0">`+data+`</h6>`;
                }
            },
            { 
                data: 'department',
                render: function(data, type, row){
                    return '<center><span class="text-muted">'+data+'</span></center>';
                } 
            },
            { 
                data: 'position',
                render: function(data, type, row){
                    return '<center><span class="text-muted">'+data+'</span></center>';
                } 
            },
            {
                data: 'datetime_appointment',
                render: function(data, type, row) {
                    return `<center><h6 class="mb-0">`+data+`</h6></center>`;
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
}

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
            url: 'php_hw/delete_article.php',
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
        url: 'php_hw/article_content_loader.php',
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
        url: 'php_hw/program_content_loader.php',
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
        url: 'php_hw/fetch_articles.php',
        success: function(response){
            $('#result-here').html(response);
        }
    });
}
// Format Fetch Articles
function Programs(){
    $.ajax({
        type: 'POST',
        url: 'php_hw/fetch_programs.php',
        success: function(response){
            $('#result-here-programs').html(response);
        }
    });
}
// Function layoutpanel behavior
function startingIntro(){
    $('#health-ad-panel1').css('display','block');
    $('#health-ad-panel2').css('display','none');
    $('#health-ad-panel3').css('display','none');
    $('#health-ad-panel4').css('display','none');
    $('#health-ad-panel5').css('display','none');
    $('#health-ad-panel6').css('display','none');
    $('#health-ad-panel7').css('display','none');
    $('#health-ad-panel8').css('display','none');
}
// JS Set Functions Here For Calling and Declare on Main Ready functions
function ColorTheme(){
    //const currentTheme = $('html').attr('data-color-theme');
    //const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    $('html').attr('data-color-theme', 'dark');
}

function SidebarButtonsHA() {
    $('#health-ad-sb1').click( function(event){
        event.preventDefault();
        $('#health-ad-panel1').css('display','block');
        $('#health-ad-panel2').css('display','none');
        $('#health-ad-panel3').css('display','none');
        $('#health-ad-panel4').css('display','none');
        $('#health-ad-panel5').css('display','none');
        $('#health-ad-panel6').css('display','none');
        $('#health-ad-panel7').css('display','none');
        $('#health-ad-panel8').css('display','none');
    });
    $('#health-ad-sb2').click( function(event){
        event.preventDefault();
        $('#health-ad-panel1').css('display','none');
        $('#health-ad-panel2').css('display','block');
        $('#health-ad-panel3').css('display','none');
        $('#health-ad-panel4').css('display','none');
        $('#health-ad-panel5').css('display','none');
        $('#health-ad-panel6').css('display','none');
        $('#health-ad-panel7').css('display','none');
        $('#health-ad-panel8').css('display','none');
    });
    $('#health-ad-sb3').click( function(event){
        event.preventDefault();
        $('#health-ad-panel1').css('display','none');
        $('#health-ad-panel2').css('display','none');
        $('#health-ad-panel3').css('display','block');
        $('#health-ad-panel4').css('display','none');
        $('#health-ad-panel5').css('display','none');
        $('#health-ad-panel6').css('display','none');
        $('#health-ad-panel7').css('display','none');
        $('#health-ad-panel8').css('display','none');
    });
    $('#health-ad-sb4').click( function(event){
        event.preventDefault();
        $('#health-ad-panel1').css('display','none');
        $('#health-ad-panel2').css('display','none');
        $('#health-ad-panel3').css('display','none');
        $('#health-ad-panel4').css('display','block');
        $('#health-ad-panel5').css('display','none');
        $('#health-ad-panel6').css('display','none');
        $('#health-ad-panel7').css('display','none');
        $('#health-ad-panel8').css('display','none');
    });
    $('#health-ad-sb5').click( function(event){
        event.preventDefault();
        $('#health-ad-panel1').css('display','none');
        $('#health-ad-panel2').css('display','none');
        $('#health-ad-panel3').css('display','none');
        $('#health-ad-panel4').css('display','none');
        $('#health-ad-panel5').css('display','block');
        $('#health-ad-panel6').css('display','none');
        $('#health-ad-panel7').css('display','none');
        $('#health-ad-panel8').css('display','none');
    });
    $('#health-ad-sb6').click( function(event){
        event.preventDefault();
        $('#health-ad-panel1').css('display','none');
        $('#health-ad-panel2').css('display','none');
        $('#health-ad-panel3').css('display','none');
        $('#health-ad-panel4').css('display','none');
        $('#health-ad-panel5').css('display','none');
        $('#health-ad-panel6').css('display','block');
        $('#health-ad-panel7').css('display','none');
        $('#health-ad-panel8').css('display','none');
    });
    $('#health-ad-sb7').click( function(event){
        event.preventDefault();
        $('#health-ad-panel1').css('display','none');
        $('#health-ad-panel2').css('display','none');
        $('#health-ad-panel3').css('display','none');
        $('#health-ad-panel4').css('display','none');
        $('#health-ad-panel5').css('display','none');
        $('#health-ad-panel6').css('display','none');
        $('#health-ad-panel7').css('display','block');
        $('#health-ad-panel8').css('display','none');
    });
    $('#health-ad-sb8').click( function(event){
        event.preventDefault();
        $('#health-ad-panel1').css('display','none');
        $('#health-ad-panel2').css('display','none');
        $('#health-ad-panel3').css('display','none');
        $('#health-ad-panel4').css('display','none');
        $('#health-ad-panel5').css('display','none');
        $('#health-ad-panel6').css('display','none');
        $('#health-ad-panel7').css('display','none');
        $('#health-ad-panel8').css('display','block');
    });
}