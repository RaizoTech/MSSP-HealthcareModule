$(document).ready(function(){
    // Default Function
    OverlaysOuts();
    SidebarButtons();
    OnboardButtonRequirements();
    // DataTables Functions Realtime
    EmployeeTable();
    //EmployeeRequest();
    OnboardingTable();
    //EmployeePerformanceTable();
    ScheduleSetListTable();
    EmployeeAttendanceTable();
    OffboardingListTable();
    LeaveRequestTable();
    RemoteRequestTable();
    JobApplicantsTable();
    countDashboard();
    // end DataTables
    const swalInit = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-light',
            denyButton: 'btn btn-light',
            input: 'form-control'
        },
        buttonsStyling: false
    });
    // Modals
    // Modal Employee Update Info Modification
    $('#modal-employee-request-info').on('show.bs.modal', function(event) {
        var idemp_seq = $(event.relatedTarget).data('idreqemp');
        $('#idtoaction').val(idemp_seq);
        $('#idtoaction2').val(idemp_seq);
        ViewRequestDetailEmployee(idemp_seq);
    });
    // Submit Approved Request Info
    $('#actions-approve-emp-request').submit( function(event){
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,  // Ensure that jQuery does not process the data
            success: function(response) {
                if (response.trim() === 'Employee update information approve & updated!') {
                    swalInit.fire(
                        'Success!',
                        response,
                        'success'
                    );
                } else {
                    swalInit.fire(
                        'Error!',
                        'Failed to approve request.',
                        'error'
                    );
                }
                $('#modal-employee-request-info').modal('hide');
            }
        });
    });
    // Submit Reject Request Info
    $('#submitRejected').click(function() {
        var formData = $('#actions-approve-reject-emp-request').serialize();
        $.post("php/employee_request_information_rejected.php", formData, function(response) {
            if (response.trim() === 'Employee update information request rejected!') {
                swalInit.fire(
                    'Success!',
                    response,
                    'success'
                );
            } else {
                swalInit.fire(
                    'Error!',
                    'Failed to reject request!.',
                    'error'
                );
            }
            $('#modal-employee-request-info').modal('hide');
        }).fail(function(xhr, status, error) {
            swalInit.fire(
                'Error!',
                'Failed to send request: ' + error,
                'error'
            );
        });
    });
    var ei_functionsCalled = false;
    $('#modal-emp-information').on('show.bs.modal', function(event) {
        if (!ei_functionsCalled) {
            var id = $(event.relatedTarget).data('idemp');
            EI_wmain_weim(id);
            EI_emp_attendance(id);
            ei_functionsCalled = true;
        }
    });
    $('#modal-emp-information').on('hide.bs.modal', function(){
        if (ei_functionsCalled) {
         $('#ei-indiv-attendance-table').DataTable().destroy();
            ei_functionsCalled = false;
        }
    });
    // Onboarde
    $('#onboardee-full-information-details').on('show.bs.modal', function(event){
        var idonb = $(event.relatedTarget).data('idonboardee');
        // Ajax
        $.ajax({
            url: 'php/onboarding_details.php',
            type: 'POST',
            dataType: 'json',
            data: {onboardID: idonb},
            success: function(response) {
                if(response && response.data) {
                    var onboard_data = response.data[0];
                    var format1D = new Date(onboard_data.orient_date);
                    var format2D = new Date(onboard_data.on_boarding_date);
                    var requirement1 = onboard_data.req1;
                    var requirement2 = onboard_data.req2;
                    var requirement3 = onboard_data.req3;
                    var requirement4 = onboard_data.req4;
                    var requirement5 = onboard_data.req5;
                    var requirement6 = onboard_data.req6;
                    var requirement7 = onboard_data.req7;
                    var formattedDate1 = format1D.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    var formattedDate2 = format2D.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    $('#onboard-name').text(onboard_data.fullname);
                    $('#onboard-orientdate').text(formattedDate1);
                    $('#onboard-date').text(formattedDate2);
                    $('#onboard-remarks').text(onboard_data.remarks);
                    // Requirements 1
                    if(!requirement1 || requirement1 === '') {
                        $('#req1pane1').html(`
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">The resource requested could not be found on this server!.</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } 
                    else {
                        $('#req1pane1').html(`
                            <h4 class="fw-semibold" style="margin-left:16px;margin-top:15px;">Medical</h4>
                            <img src="https://jobfair.workfoliohumanresource.com/public/upload_files/basisFiles/` + requirement1 + `" class="img-fluid" alt="requirement image">
                        `);
                    }
                    // Requirements 2
                    if(!requirement2 || requirement2 === '') {
                        $('#req1pane2').html(`
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">The resource requested could not be found on this server!.</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } 
                    else {
                        $('#req1pane2').html(`
                            <h4 class="fw-semibold" style="margin-left:16px;margin-top:15px;">NBI</h4>
                            <img src="https://jobfair.workfoliohumanresource.com/public/upload_files/basisFiles/` + requirement2 + `" class="img-fluid" alt="requirement image">
                        `);
                    }
                    // Requirements 3
                    if(!requirement3 || requirement3 === '') {
                        $('#req1pane3').html(`
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">The resource requested could not be found on this server!.</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } 
                    else {
                        $('#req1pane3').html(`
                            <h4 class="fw-semibold" style="margin-left:16px;margin-top:15px;">PhilHealth</h4>
                            <img src="https://jobfair.workfoliohumanresource.com/public/upload_files/basisFiles/` + requirement3 + `" class="img-fluid" alt="requirement image">
                        `);
                    }
                    // Requirements 4
                    if(!requirement4 || requirement4 === '') {
                        $('#req1pane4').html(`
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">The resource requested could not be found on this server!.</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } 
                    else {
                        $('#req1pane4').html(`
                            <h4 class="fw-semibold" style="margin-left:16px;margin-top:15px;">SSS</h4>
                            <img src="https://jobfair.workfoliohumanresource.com/public/upload_files/basisFiles/` + requirement4 + `" class="img-fluid" alt="requirement image">
                        `);
                    }
                    // Requirements 5
                    if(!requirement5 || requirement5 === '') {
                        $('#req1pane5').html(`
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">The resource requested could not be found on this server!.</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } 
                    else {
                        $('#req1pane5').html(`
                            <h4 class="fw-semibold" style="margin-left:16px;margin-top:15px;">Brgy. Clearance</h4>
                            <img src="https://jobfair.workfoliohumanresource.com/public/upload_files/basisFiles/` + requirement5 + `" class="img-fluid" alt="requirement image">
                        `);
                    }
                    // Requirements 6
                    if(!requirement6 || requirement6 === '') {
                        $('#req1pane6').html(`
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">The resource requested could not be found on this server!.</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } 
                    else {
                        $('#req1pane6').html(`
                            <h4 class="fw-semibold" style="margin-left:16px;margin-top:15px;">TIN ID</h4>
                            <img src="https://jobfair.workfoliohumanresource.com/public/upload_files/basisFiles/` + requirement6 + `" class="img-fluid" alt="requirement image">
                        `);
                    }
                    // Requirements 7
                    if(!requirement7 || requirement7 === '') {
                        $('#req1pane7').html(`
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">The resource requested could not be found on this server!.</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } 
                    else {
                        $('#req1pane7').html(`
                            <h4 class="fw-semibold" style="margin-left:16px;margin-top:15px;">Picture</h4>
                            <img src="https://jobfair.workfoliohumanresource.com/public/upload_files/basisFiles/` + requirement7 + `" class="img-fluid" alt="requirement image">
                        `);
                    }
                    // Actions Buttons
                    $('#action-buttons-onboardee').html(`
                        <div class="card-body">
                            <form id="onboard-update-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="applicant_id" value="`+onboard_data.applicant_id+`">
                                        <select class="form-control select" data-minimum-results-for-search="Infinity" name="decision_value">
                                            <option value="" disabled selected>Select Status</option> <!-- Add 'selected' here -->
                                            <optgroup label="Approved Or Qualified">
                                                <option value="Approved">Approved</option>
                                                <option value="Qualified">Qualified</option>
                                            </optgroup>
                                            <optgroup label="Declined Or Reject">
                                                <option value="Declined">Declined</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    `);
                } else {
                    $('#onboard-name').text('N/A');
                    $('#onboard-orientdate').text('N/A');
                    $('#onboard-date').text('N/A');
                    $('#onboard-remarks').text('N/A');
                }
            }
        });
    });
    // Leave Info Modals
    $('#leave-info').on('show.bs.modal', function(event){
        var data1 = $(event.relatedTarget).data('idleave');
        // AJAX
        $.ajax({
            url: 'php/leave_request_detail.php',
            type: 'POST',
            dataType: 'json',
            data: {row_id: data1},
            success: function(response) {
                if (response && response.leave_detail) {
                    var leave_details = response.leave_detail[0];
                    // Image Checker
                    var img_checker_leave = leave_details.img_checker;
                    // Date Formats
                    var date_to = leave_details.ToDate;
                    var date_from = leave_details.FromDate;
                    var date_request = leave_details.PostingDate;
                    // Set New Date
                    var dateformat1 = new Date(date_to);
                    var dateformat2 = new Date(date_from);
                    var dateformat3 = new Date(date_request);
                    // New Formats
                    var formattedDate1 = dateformat1.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    var formattedDate2 = dateformat2.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    var formattedDateTime3 = dateformat3.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        hour12: true
                    });
                    // Descriptions and text
                    var leave_description = leave_details.Description;
                    $('#leaver-name').text(leave_details.fullname);
                    $('#leave-type').text(leave_details.LeaveType);
                    $('#leave-todate').text(formattedDate1);
                    $('#leave-fromdate').text(formattedDate2);
                    $('#leave-reqdatete').text(formattedDateTime3);
                    $('#leave-description').html(`
                        `+leave_details.Description+`
                    `);
                    if (!img_checker_leave || img_checker_leave === '') {
                        $('#img-basis-leave-detail').html(`
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">The resource requested could not be found on this server!.</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } else {
                        $('#img-basis-leave-detail').html(`
                            <img src="https://leave-benefits.workfoliohumanresource.com/EmployeeLeaveSystem/Images/`+img_checker_leave+`" class="img-fluid" alt="Hatdog">
                        `);
                    }
                    $('#status-decision').html(`
                        <div class="card-body">
                            <h5 class="fw-semibold">Actions</h5>
                            <form id="leave-manager-decision-form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="row_id_leave" value="`+leave_details.id+`">
                                        <textarea rows="3" cols="3" class="form-control" placeholder="Remark note" name="admin_remark_note" id="textarea-note"></textarea>
                                        <br>
                                        <select class="form-control select" id="textarea_popup" data-minimum-results-for-search="Infinity" name="decision_value">
                                            <option value="" disabled selected>Select Here</option> <!-- Add 'selected' here -->
                                            <option value="1">Approved</option>
                                            <option value="2">Declined</option>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    `);
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    });
    // Modal Applicant View 
    $('#applicant-details').on('show.bs.modal', function(event){
        var idapplicant = $(event.relatedTarget).data('idapp');
        var iddata = {applicant_id: idapplicant};
        // AJAX GET Method
        $.ajax({
            url: 'php/applicant_details.php',
            type: 'POST',
            dataType: 'json',
            data: iddata,
            success: function(response){
                if (response && response.app_data) {
                    var applicant_data_array = response.app_data[0];
                    var img_checker = applicant_data_array.applicant_image;
                    $('#applicant-name').text(applicant_data_array.fullname);
                    $('#applicant-gender').text(applicant_data_array.gender);
                    var dobdate = new Date(applicant_data_array.birthday);
                    var birthdob_formatted = dobdate.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    $('#applicant-dob').text(birthdob_formatted);
                    $('#applicant-age').text(applicant_data_array.age);
                    $('#applicant-civil-status').text(applicant_data_array.civil_status);
                    $('#applicant-email').text(applicant_data_array.email);
                    $('#applicant-address').text(applicant_data_array.address);
                    $('#applicant-contact').text(applicant_data_array.contact_no);
                    $('#applicant-category').text(applicant_data_array.job_category);
                    $('#applicant-position').text(applicant_data_array.position_);
                    var date = new Date(applicant_data_array.registration_date);
                    var formattedDate = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    $('#applicant-regdate').text(formattedDate);
                    $('#applicant-company').text(applicant_data_array.company_name);
                    // New Row Left
                    $('#applicant-view-actions-form').html(`
                        <form id="action-applicant-update">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" id="applicant-id-form" name="applicant_id" value="`+applicant_data_array.applicant_id+`">
                                    <select class="form-control select" data-minimum-results-for-search="Infinity" name="decision_value" id="decision-applicant">
                                        <option value="" disabled selected>Set Status</option> <!-- Add 'selected' here -->
                                        <option value="Approved">Approved</option>
                                        <option value="Qualified">Qualified</option>
                                        <option value="Failed">Failed</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label col-lg-3"> </label>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    `);
                    // Image checker 
                    if (!img_checker || img_checker === '') {
                        $('#applicant-images').html(`
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">The resource requested could not be found on this server!.</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } else{
                        $('#applicant-images').html(`
                            <img src="https://jobfair.workfoliohumanresource.com/public/upload_files/applicantfiles/`+img_checker+`" class="img-fluid" alt="Hatdog">
                        `);
                    }
                }
                else {

                }
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    });
    // Remote Get Details Selected
    $('#modal-emp-remote-request').on('show.bs.modal', function(event){
        var remote_id = $(event.relatedTarget).data('idremote_req');
        var idremote = {emp_id: remote_id};
        // AJAX
        $.ajax({
            url: 'php/remote_request_detail.php',
            type: 'POST',
            dataType: 'json',
            data: idremote,
            success: function(response) {
                if (response && response.remote_details) {
                    // set variable
                    var remoteData = response.remote_details[0];
                    // Other and set var 
                    var fullname = remoteData.fullname;
                    var total_score = remoteData.total_score;
                    var request_reason = remoteData.request_reason;
                    $('#remote-name').text(fullname);
                    $('#remote-totalscore').text(total_score);
                    //$('#remote-reason').text(request_reason);
                    // Get the date and set Format
                    var date_request = remoteData.request_date;
                    var dateval = new Date(date_request);
                    var formattedDateRequest = dateval.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    $('#remote-reqdate').text(formattedDateRequest);
                    // Get the values every question 1 to 9
                    var question1 = remoteData.q1;
                    var question2 = remoteData.q2;
                    var question3 = remoteData.q3;
                    var question4 = remoteData.q4;
                    var question5 = remoteData.q5;
                    var question6 = remoteData.q6;
                    var question7 = remoteData.q7;
                    var question8 = remoteData.q8;
                    var question9 = remoteData.q9;
                    // Set Radio Buttons
                    // Q1
                    $('.jobrole_suitability').filter(function() {
                        return $(this).val() == question1;
                    }).prop('checked', true);
                    // Q2
                    $('.performance_accountability').filter(function() {
                        return $(this).val() == question2;
                    }).prop('checked', true);
                    // Q3
                    $('.technological_readiness').filter(function() {
                        return $(this).val() == question3;
                    }).prop('checked', true);
                    // Q4
                    $('.communication_skills').filter(function() {
                        return $(this).val() == question4;
                    }).prop('checked', true);
                    // Q5
                    $('.work_environment').filter(function() {
                        return $(this).val() == question5;
                    }).prop('checked', true);
                    // Q6
                    $('.flexibility_adaptability').filter(function() {
                        return $(this).val() == question6;
                    }).prop('checked', true);
                    // Q7
                    $('.health_wellbeing').filter(function() {
                        return $(this).val() == question7;
                    }).prop('checked', true);
                    // Q8
                    $('.organizational_needs').filter(function() {
                        return $(this).val() == question8;
                    }).prop('checked', true);
                    // Q9
                    $('.legal_compliance').filter(function() {
                        return $(this).val() == question9;
                    }).prop('checked', true);
                    // Set Actions button
                    var idremote_tosubmit_decision = remoteData.id;
                    $('#remote-decision-actions').html(`
                        <form id="action-remote-request-update">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" name="emp_id_identifier" value="`+idremote_tosubmit_decision+`">
                                    <select class="form-control select" data-minimum-results-for-search="Infinity" name="decision_value" id="decision-remote-status">
                                        <option value="" disabled selected>Set Status</option> <!-- Add 'selected' here -->
                                        <option value="Approved">Approved</option>
                                        <option value="Declined">Declined</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label col-lg-3"> </label>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    `);
                    $('#remote-reason').html(`
                        <div class="mb-3">
                            <span class="fw-semibold">Reason</span>
                            <div class="ms-auto">`+request_reason+`</div>
                        </div>
                    `);
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    });
    // Offboarding Detail
    $('#offboard_detail').on('show.bs.modal', function(event){
        // Get Value ID
        var idoffboard = $(event.relatedTarget).data('idoffboardid');
        // Set AJAX
        $.ajax({
            url: 'php/offboard_update_status.php',
            type: 'POST',
            dataType: 'json',
            data: {offboard_id: idoffboard},
            success: function(response) {
                // Response get JSON Response
                if (response && response.offdetail) {
                    // Set Variable and Assigned Variables
                    var offboard_fulldetail = response.offdetail[0];
                    var formID = offboard_fulldetail.id;
                    var fullname = offboard_fulldetail.fullname;
                    var department = offboard_fulldetail.department;
                    var position = offboard_fulldetail.position;
                    var workstatus = offboard_fulldetail.workstatus;
                    var worksetup = offboard_fulldetail.worksetup;
                    var requesttype = offboard_fulldetail.request_type;
                    var offboard_date = offboard_fulldetail.request_date;
                    var description = offboard_fulldetail.offboard_reason;
                    var filename = offboard_fulldetail.file_name;
                    var date = new Date(offboard_date);
                    var formattedDate = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    if (!filename || filename === ''){
                        $('#offboard-file-letter-or-retirement').html(`
                            <h4 class="fw-semibold" style="margin-top:15px;margin-left:17px;">File Basis</h4>
                            <div class="content d-flex justify-content-center align-items-center">
                                <div class="flex-fill">
                                    <div class="text-center mb-4">
                                        <img src="assets1/images/error_bg.svg" class="img-fluid mb-3" height="230" alt="">
                                        <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                                        <h6 class="w-md-25 mx-md-auto">No File Submitted!</h6>
                                    </div>
                                </div>
                            </div>
                        `);
                    } else {
                        $('#offboard-file-letter-or-retirement').html(`
                            <h4 class="fw-semibold" style="margin-top:15px;margin-left:17px;">File Basis</h4>
                            <img src="https://employeetosfs.workfoliohumanresource.com/storage/app/offboarding_files/`+filename+`" class="img-fluid" alt="letter file offboard or retirement">
                        `);
                    }
                    // Variables Text ID
                    $('#offboard-name').text(fullname);
                    $('#offboard-department').text(department);
                    $('#offboard-position').text(position);
                    $('#offboard-workstatus').text(workstatus);
                    if (worksetup === 'remote'){
                        $('#offboard-worksetup').text('Remote');
                    } else if(worksetup === 'onsite'){
                        $('#offboard-worksetup').text('Onsite');
                    }
                    $('#offboard-requesttype').text(requesttype);
                    $('#offboard-date').text(formattedDate);
                    $('#offboard-description').text(description);
                    $('#offboard-status-action').html(`
                        <form id="action-offboard-request-update">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" name="offbaord_id" value="`+formID+`">
                                    <select class="form-control select" data-minimum-results-for-search="Infinity" name="decision_value" id="decision-remote-status">
                                        <option value="" disabled selected>Set Status</option> <!-- Add 'selected' here -->
                                        <option value="Approved">Approved</option>
                                        <option value="Denied">Denied</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    `);
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    });
    // End Modals
    // Other Internal Functions
    // Leave Management Form Action
    $(document).on('submit', '#leave-manager-decision-form', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        // Create a FormData object to collect form data
        var formData = new FormData(this);
        // Make an Ajax request to submit the form data
        $.ajax({
            url: 'php/leave_manager_decision.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response === 'Success1') {
                    swalInit.fire(
                        'Approved!',
                        'Leave request approved',
                        'success'
                    );
                }
                else if (response === 'Success2') {
                    swalInit.fire(
                        'Declined!',
                        'Leave request decline and note sended!',
                        'error'
                    );
                }
                $('#leave-info').modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the Ajax request
                swalInit.fire(
                    'Javascript Error',
                    'Error in: '+error,
                    'error'
                );
            }
        });
    });
    // Offboading Form Action
    $(document).on('submit', '#action-offboard-request-update', function(event){
        // Prevent the default form submission behavior
        event.preventDefault();
        // Create a FormData object to collect form data
        var formData = new FormData(this);
        // Make an Ajax request to submit the form data
        $.ajax({
            url: 'php/offboard_decision_status.php',
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            success: function(response) {
                // Response Result Message
                if (response === 'Offboard Request Approved!') {
                    swalInit.fire(
                        'Offboard Approved!',
                        response,
                        'success'
                    );
                } 
                else if (response === 'Offboard Request Denied!') {
                    swalInit.fire(
                        'Offboard Denied!',
                        response,
                        'error'
                    );
                }
                $('#offboard_detail').modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    });
    // Remote Request Decision Manager
    $(document).on('submit', '#action-remote-request-update', function(event){
        // Prevent the default form submission behavior
        event.preventDefault();
        // Create a FormData object to collect form data
        var formData = new FormData(this);
        // Make an Ajax request to submit the form data
        $.ajax({
            url: 'php/remote_request_status_decision.php',
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            success: function(response) {
                // Response
                if (response === "Employee remote request approved!") {
                    swalInit.fire(
                        'Remote Request Approved!',
                        response,
                        'success'
                    );
                }
                else if (response === "Employee remote request declined!") {
                    swalInit.fire(
                        'Remote Request Declined!',
                        response,
                        'error'
                    );
                }
                $('#modal-emp-remote-request').modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    });
    // Applicant Approval Submission Decision
    $(document).on('submit', '#action-applicant-update', function(event){
        // Prevent the default form submission behavior
        event.preventDefault();
        var app_id_res = $('#applicant-id-form').val();
        // Create a FormData object to collect form data
        var formData = new FormData(this);
        // Make an Ajax request to submit the form data
        $.ajax({
            url: 'php/applicant_manager_decision.php',
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            success: function(response) {
                // Response 
                if(response === 'Applicant '+app_id_res+' approved!'){
                    swalInit.fire(
                        'Applicant Approved!',
                        response,
                        'success'
                    );
                }
                else if(response === 'Applicant '+app_id_res+' qualified!'){
                    swalInit.fire(
                        'Applicant Qualified!',
                        response,
                        'success'
                    );
                }
                else if(response === 'Applicant '+app_id_res+' set to failed!'){
                    swalInit.fire(
                        'Applicant Failed!',
                        response,
                        'error'
                    );
                }
                $('#applicant-details').modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    });
    // Onboard actions button
    $(document).on('submit', '#onboard-update-form', function(event){
        // Prevent the default form submission behavior
        event.preventDefault();
        // Create a FormData object to collect form data
        var formData = new FormData(this);
        // Make an Ajax request to submit the form data
        $.ajax({
            url: 'php/onboard_decision.php',
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            success: function(response) {
                // Handle the successful response from the server
                if(response === "Onboard Approved!"){
                    swalInit.fire(
                        'Approved!',
                        response,
                        'success'
                    );
                }
                else if(response === "Onboard Qualified!"){
                    swalInit.fire(
                        'Qualified!',
                        response,
                        'success'
                    );
                }
                else if(response === "Onboard Declined!"){
                    swalInit.fire(
                        'Declined!',
                        response,
                        'error'
                    );
                }
                else {
                    swalInit.fire(
                        'Declined!',
                        response,
                        'info'
                    );
                }
                $('#onboardee-full-information-details').modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    });
    // Leave Action Buttons
    $('#btn-leave-approved').click(function(){
        var formData = $('#approve-reject-leave-form').serialize();
        $.post("php/leave_approved.php", formData, function(response){
            if(response.trim() === 'Leave request approved!'){
                swalInit.fire(
                    'Success!',
                    'Leave Request Approved!',
                    'success'
                );
                $('#leave-info').modal('hide');
            }
        });
    });
    $('#btn-leave-denied').click(function(){
        var formData = $('#approve-reject-leave-form').serialize();
        $.post("php/leave_denied.php", formData, function(response){
            if(response.trim() === 'Leave request denied!'){
                swalInit.fire(
                    'Success!',
                    'Leave Request Denied!',
                    'success'
                );
                $('#leave-info').modal('hide');
            }
        });
    });
});
// External Functions
function ViewRequestDetailEmployee(idtorequest){
    var data_post = {id_emp: idtorequest};
    $.ajax({
        url: 'php/employee_request_update_viewf.php',
        method: 'POST',
        dataType: 'json',        
        data: data_post,
        success: function(response){
            if (response && response.data_view_information_request) {
                var employeeRequestInformationDetail = response.data_view_information_request[0];
                var date = new Date(employeeRequestInformationDetail.date_of_birth);
                var formattedDateDOB = date.toLocaleString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                $('#eriu-fullname').text(employeeRequestInformationDetail.fullname);
                $('#eriu-dob').text(formattedDateDOB);
                $('#eriu-gender').text(employeeRequestInformationDetail.gender);
                $('#eriu-email').text(employeeRequestInformationDetail.email);
                $('#eriu-contact-number').text(employeeRequestInformationDetail.contact_number);
                $('#eriu-address').text(employeeRequestInformationDetail.address);
                $('#eriu-civil-status').text(employeeRequestInformationDetail.civil_status);
                $('#datetoaction').val(employeeRequestInformationDetail.request_date);
            } else {
                $('#eriu-fullname').text('N/A');
                $('#eriu-dob').text('N/A');
                $('#eriu-gender').text('N/A');
                $('#eriu-email').text('N/A');
                $('#eriu-contact-number').text('N/A');
                $('#eriu-address').text('N/A');
                $('#eriu-civil-status').text('N/A');
            }
        }
    });
}
// Modal View EI
function EI_wmain_weim(idemp){
    var idemployee = idemp;
    var idemployee2 = idemp;
    // For work_main
    $.ajax({
        url: 'php/ei-work-main-employees-credentials.php',
        type: 'POST',
        dataType: 'json',
        data: {ei_emp_id: idemployee2},
        success: function(response){
            // Handle data json
            if(response && response.data){
                var employeeData1 = response.data[0]; // Assuming there's only one employee data
                // Set the fetched data to the respective HTML elements
                $('#ei-name').text(employeeData1.fullname);
                $('#ei-work-status').text(employeeData1.work_status);
                $('#ei-position').text(employeeData1.work_position);
                $('#ei-department').text(employeeData1.work_department);
                $('#ei-email').text(employeeData1.work_email);
            } else {
                // Handle if no data found
                $('#ei-work-status').text('N/A');
                $('#ei-position').text('N/A');
                $('#ei-department').text('N/A');
                $('#ei-email').text('N/A');
                // Add more lines to set other data to default values or show error messages
            }
        },
        error: function(xhr, status, error){
            console.error('Error:', error);
        }
    });
    // For work_eim
    $.ajax({
        url: 'php/ei-information-employees-credentials.php',
        type: 'POST',
        dataType: 'json',
        data: {ei_emp_id: idemployee},
        success: function(response){
            // Handle data json
            if(response && response.data){
                var employeeData2 = response.data[0]; // Assuming there's only one employee data
                var dob = new Date(employeeData2.date_of_birth);
                var today = new Date();
                var age = today.getFullYear() - dob.getFullYear();
                // Adjust age if birthday hasn't occurred yet this year
                var month = today.getMonth() - dob.getMonth();
                if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }
                var formattedDate = dob.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });  
                // Set the fetched data to the respective HTML elements
                $('#ei-dob').text(formattedDate);
                $('#ei-age').text(age);
                $('#ei-placebirth').text(employeeData2.place_of_birth);
                $('#ei-gender').text(employeeData2.sex);
                $('#ei-civil-status').text(employeeData2.civil_stat);
            } else {
                // Handle if no data found
                $('#ei-dob').text('N/A');
                $('#ei-placebirth').text('N/A');
                $('#ei-gender').text('N/A');
                $('#ei-civil-status').text('N/A');
                // Add more lines to set other data to default values or show error messages
            }
        },
        error: function(xhr, status, error){
            console.error('Error:', error);
        }
    });
}
// Populate Table Individual Attendance
function EI_emp_attendance(idemp) {
    function formatTotalHours(totalHours) {
        // Convert total hours to hours and minutes
        var hours = Math.floor(totalHours);
        var minutes = Math.round((totalHours - hours) * 60);

        // Format the result
        var result = hours + 'hrs ';
        if (minutes > 0) {
            result += minutes + 'm';
        }
        return result;
    }

    var table_indiv_attendance = $('#ei-indiv-attendance-table').DataTable({
        ajax: {
            url: 'php/ei-viewing-individual-attendance.php',
            method: 'POST',
            data: {request_id: idemp},
            dataSrc: 'data'
        },
        columns: [
            {
                data: 'date_in',
                render: function(data, type, row) {
                    var date = new Date(data);
                    var formattedDate = date.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                    return formattedDate;
                }
            },
            {
                data: 'time_in',
                render: function(data, type, row) {
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
                    return formattedTime;
                }
            },
            {
                data: 'time_out',
                render: function(data, type, row) {
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
                    return formattedTime;
                }
            },
            {
                data: 'working_hours',
                render: function(data, type, row) {
                    return formatTotalHours(data); // Apply the formatTotalHours function to format total hours
                }
            },
            { data: 'status' }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    $('#refresh-indiv-attendance-table').click(function(){
        table_indiv_attendance.ajax.reload();
    });
}
// Table Employees
function EmployeeTable(){
    var emp_table_all = $('#employee-table1').DataTable({
        ajax: {
            url: 'php/employee_all.php',
            dataSrc: 'data'
        },
        columns: [
            { data: 'fullname' } ,          
            { data: 'position' },
            { data: 'department' },
            { data: 'status'},
            {
                data: 'code',
                render: function(data, type, row){
                    return '<center><button type="button" class="btn btn-primary" data-idemp="'+data+'" data-bs-toggle="modal" data-bs-target="#modal-emp-information">View</button></center>';
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function UpdateEmployeeTable(){
        emp_table_all.ajax.reload(null, false);
    }
    setInterval(UpdateEmployeeTable, 1000);
}
// Table Employee Request
function EmployeeRequest(){
    var emp_request_info_table = $('#employee-info-request-table').DataTable({
        ajax: {
            url: 'php/employee_request_information_list.php',
            dataSrc: 'employee_request_data'
        },
        columns: [
            { data: 'full_name' },
            { data: 'position_' },
            { data: 'department' },
            {
                data: 'request_date',
                render: function(data, type, row){
                    var datetime_val = new Date(data);
                    var formattedDateTime = datetime_val.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hours: 'numeric',
                        minutes: 'numeric',
                        hour12: true
                    });
                    return formattedDateTime;
                }
            },
            {
                data: 'id',
                render: function(data, type, row){
                    return '<center><button class="btn btn-primary" data-idreqemp="'+data+'" data-bs-toggle="modal" data-bs-target="#modal-employee-request-info">View</button></center>'
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function UpdateEmployeeRequestInfoTable(){
        emp_request_info_table.ajax.reload(null, false);
    }
    setInterval(UpdateEmployeeRequestInfoTable, 1000);
}
// Table Performance
function EmployeePerformanceTable(){
    var emp_performance_all = $('#employee-performances').DataTable({
        ajax: {
            url: 'php/employee_performance_all.php',
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
                data: 'ave_feedback_rating',
                render: function(data, type, row){
                    return '<center>'+data+'%</center>';
                }
            },
            { 
                data: 'ave_present',
                render: function(data, type, row){
                    return '<center>'+data+'%</center>';
                }
            },
            { 
                data: 'ave_absent',
                render: function(data, type, row){
                    return '<center>'+data+'%</center>';
                }
            },
            {
                data: 'code',
                render: function(data, type, row) {
                    return '<center><button class="btn btn-primary" data-idemp_per="'+data+'" data-bs-toggle="modal" data-bs-target="#">View Details</button></center>'
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function UpdateEmployeePerformanceTable(){
        emp_performance_all.ajax.reload(null, false);
    }
    setInterval(UpdateEmployeePerformanceTable, 1000);
}
// Table Onboarding
function OnboardingTable(){
    var onboarding_list_table = $('#onboarding-list-table').DataTable({
        ajax: {
            url: 'php/onboarding_list.php',
            dataSrc: 'data'
        },
        columns: [
            { data: 'fullname' },
            { data: 'position_' },
            { data: 'company' },
            { 
                data: 'on_boarding_date',
                render: function(data, type, row){
                    var date = new Date(data);
                    var formattedDate = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    if(data.trim() === '0000-00-00'){
                        return 'Not Set';
                    } else {
                        return formattedDate;
                    }
                } 
            },
            {
                data: 'onboard_id', 
                render: function(data, type, row) {
                    return '<center><button class="btn btn-primary" data-idonboardee="'+data+'" data-bs-toggle="modal" data-bs-target="#onboardee-full-information-details">Details</button></center>';
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function UpdateOnboardingListTable(){
        onboarding_list_table.ajax.reload(null, false);
    }
    setInterval(UpdateOnboardingListTable, 1000);
}
// Table Schedules & Attendance
// Schedules
function ScheduleSetListTable(){
    var new_set_schedule = $('#schedules-set-table').DataTable({
        ajax: {
            url: 'php/schedules_new.php',
            dataSrc: 'data'
        },
        columns: [
            { data: 'rotate_sched' },
            { 
                data: 'shift',
                render: function(data, type, row) {
                    return '<center>'+data+'</center>';
                }
            },
            { 
                data: 'time_inout',
                render: function(data, type, row) {
                    return '<center>'+data+'</center>';
                }
            },
            { data: 'formatted_total_hours' }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function UpdateScheduleTable() {
        new_set_schedule.ajax.reload(null, false);
    }
    setInterval(UpdateScheduleTable, 1000);
}
// Attendance
function EmployeeAttendanceTable() {
    function formatTotalHours(totalHours) {
        // Convert total hours to hours and minutes
        var hours = Math.floor(totalHours);
        var minutes = Math.round((totalHours - hours) * 60);

        // Format the result
        var result = hours + 'hrs ';
        if (minutes > 0) {
            result += minutes + 'm';
        }
        return result;
    }
    var attendance_all = $('#employee-attendances').DataTable({
        ajax: {
            url: 'php/attendance_all.php',
            dataSrc: 'data'
        },
        columns: [
            { data: 'fullname' },
            {
                data: 'date',
                render: function(data, type, row) {
                    if (data) {
                        var date = new Date(data);
                        var formattedDate = date.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                        return formattedDate;
                    } else {
                        return '';
                    }
                }
            },
            {
                data: 'time_in',
                render: function(data, type, row) {
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
                    return formattedTime;
                }
            },
            {
                data: 'time_out',
                render: function(data, type, row) {
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
                    return formattedTime;
                }
            },
            { data: 'status' },
            { 
                data: 'working_hours',
                render: function(data, type, row) {
                    return formatTotalHours(data); // Apply the formatTotalHours function to format total hours
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });

    function UpdateAttendanceTable() {
        attendance_all.ajax.reload(null, false);
    }

    setInterval(UpdateAttendanceTable, 1000);
}
// Table Offboarding
function OffboardingListTable(){
    var offboarding_list_table = $('#offboarding-list-approval').DataTable({
        ajax: {
            url: 'php/offboarding_list.php',
            dataSrc: 'offboard_list'
        },
        columns: [
            { data: 'code' },
            { data: 'fullname' },
            { data: 'position' },
            { data: 'request_type' },
            {
                data: 'request_date',
                render: function(data, type, row){
                    var date = new Date(data);
                    var formattedDate = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    return formattedDate;
                }
            },
            {
                data: 'id',
                render: function(data, type, row) {
                    return '<center><button type="button" class="btn btn-primary" data-idoffboardid="'+data+'" data-bs-toggle="modal" data-bs-target="#offboard_detail">View</button></center>';
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function UpdateOffboardingTable() {
        offboarding_list_table.ajax.reload(null, false);
    }
    setInterval(UpdateOffboardingTable, 1000);
}
// Table Leave Request
function LeaveRequestTable(){
    var leave_request_table = $('#leave-request-table').DataTable({
        ajax: {
            url: 'php/leave_request_all.php',
            dataSrc: 'data'
        },
        columns: [
            { data: 'code' },
            { data: 'fullname' },
            { 
                data: 'LeaveType',
                render: function(data, type, row) {
                    return '<center>'+data+'</center>';
                }
            },
            {
                data: 'ToDate',
                render: function(data, type, row){
                    var datetime = new Date(data);
                    var formattedDateTime = datetime.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                    return formattedDateTime;
                }
            },
            {
                data: 'FromDate',
                render: function(data, type, row){
                    var datetime = new Date(data);
                    var formattedDateTime = datetime.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                    return formattedDateTime;
                }
            },
            {
                data: 'id',
                render: function(data, type, row) { 
                    return '<center><button type="button" class="btn btn-primary" data-idleave="'+data+'" data-bs-toggle="modal" data-bs-target="#leave-info">View</button></center>';
                } 
                
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function UpdateLeaveRequestTable(){
        leave_request_table.ajax.reload(null, false);
    }
    setInterval(UpdateLeaveRequestTable, 1000);
}
// Table Remote Request
function RemoteRequestTable(){
    var remote_request_table = $('#remote-request-table').DataTable({
        ajax: {
            url: 'php/remote_request_all.php',
            dataSrc: 'data'
        },
        columns: [
            { data: 'code' },
            { data: 'full_name' },
            { data: 'total_score' },
            { 
                data: 'date_request',
                render: function(data, type, row){
                    var date = new Date(data);
                    var formattedDate = date.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                    return formattedDate;
                } 
            },
            {
                data: 'id',
                render: function(data, type, row){
                    return '<center><button class="btn btn-primary" data-idremote_req="'+data+'" data-bs-toggle="modal" data-bs-target="#modal-emp-remote-request">View</button></center>';
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function UpdateRemoteRequestTable(){
        remote_request_table.ajax.reload(null, false);
    }
    setInterval(UpdateRemoteRequestTable, 1000);
}
// Table Job Applicants
function JobApplicantsTable(){
    var job_applicants_table = $('#applicants-list-table').DataTable({
        ajax: {
            url: 'php/job_applicants_all.php',
            dataSrc: 'data'
        },
        columns: [
            { data: 'full_name' },
            { data: 'email' },
            { data: 'contact_no' },
            { data: 'applying_position' },
            { data: 'category_position' },
            {
                data: 'applicant_id',
                render: function(data, type, row) {
                    return '<center><button class="btn btn-primary" data-idapp="'+data+'" data-bs-toggle="modal" data-bs-target="#applicant-details">View</button></center>';
                }
            }
        ],
        initComplete: function(settings, json) {
            console.log(json); // Log the JSON response to the console
        }
    });
    function UpdateJobApplicantsTable(){
        job_applicants_table.ajax.reload(null, false);
    }
    setInterval(UpdateJobApplicantsTable, 1000);
}
function countDashboard(){
    setInterval(function() {
        $.ajax({
            url: 'php/dashboard_counts.php',
            type: 'POST',
            dataType: 'json',
            success: function(response){
                if(response && response.data) {
                    var count_name1 = response.data[0];
                    var count_name2 = response.data[1];
                    var count_name3 = response.data[2];
                    var count_name4 = response.data[3];
                    // Update the HTML elements with the count values
                    $('#total-employees').text(count_name1.total_employees);
                    $('#total-remote-req').text(count_name2.total_remoterequest);
                    $('#total-leave-req').text(count_name3.total_leaverequest);
                    $('#onboarding_total').text(count_name4.total_onboarding);
                }
                else {
                    $('#total-employees').text('N/A');
                    $('#total-remote-req').text('N/A');
                    $('#total-leave-req').text('N/A');
                    $('#onboarding_total').text('N/A');
                }
            }
        });
    }, 1000); // 1000 milliseconds = 1 second
}

// Overlayouts
function OverlaysOuts(){
    $('#hr_p1').css('display','block');
    $('#hr_p2').css('display','none');
    $('#hr_p3').css('display','none');
    $('#hr_p4').css('display','none')
    $('#hr_p6').css('display','none');
    $('#hr_p7').css('display','none');
    $('#hr_p8').css('display','none');
    $('#hr_p9').css('display','none');
    $('#extra-panel1').css('display','none');
    $('#extra-panel2').css('display','none');
    $('#employee-request-panel').css('display','none');
}
// Onboard Buttons to requirement viewing
function OnboardButtonRequirements(){
    // Tempo Panel
    $('#req1pane1').css('display','block');
    $('#req1pane2').css('display','none');
    $('#req1pane3').css('display','none');
    $('#req1pane4').css('display','none');
    $('#req1pane5').css('display','none');
    $('#req1pane6').css('display','none');
    $('#req1pane7').css('display','none');
    $('#onboard-req-viewer-button1').click(function(){
        $('#req1pane1').css('display','block');
        $('#req1pane2').css('display','none');
        $('#req1pane3').css('display','none');
        $('#req1pane4').css('display','none');
        $('#req1pane5').css('display','none');
        $('#req1pane6').css('display','none');
        $('#req1pane7').css('display','none');
    });
    $('#onboard-req-viewer-button2').click(function(){
        $('#req1pane1').css('display','none');
        $('#req1pane2').css('display','block');
        $('#req1pane3').css('display','none');
        $('#req1pane4').css('display','none');
        $('#req1pane5').css('display','none');
        $('#req1pane6').css('display','none');
        $('#req1pane7').css('display','none');
    });
    $('#onboard-req-viewer-button3').click(function(){
        $('#req1pane1').css('display','none');
        $('#req1pane2').css('display','none');
        $('#req1pane3').css('display','block');
        $('#req1pane4').css('display','none');
        $('#req1pane5').css('display','none');
        $('#req1pane6').css('display','none');
        $('#req1pane7').css('display','none');
    });
    $('#onboard-req-viewer-button4').click(function(){
        $('#req1pane1').css('display','none');
        $('#req1pane2').css('display','none');
        $('#req1pane3').css('display','none');
        $('#req1pane4').css('display','block');
        $('#req1pane5').css('display','none');
        $('#req1pane6').css('display','none');
        $('#req1pane7').css('display','none');
    });
    $('#onboard-req-viewer-button5').click(function(){
        $('#req1pane1').css('display','none');
        $('#req1pane2').css('display','none');
        $('#req1pane3').css('display','none');
        $('#req1pane4').css('display','none');
        $('#req1pane5').css('display','block');
        $('#req1pane6').css('display','none');
        $('#req1pane7').css('display','none');
    });
    $('#onboard-req-viewer-button6').click(function(){
        $('#req1pane1').css('display','none');
        $('#req1pane2').css('display','none');
        $('#req1pane3').css('display','none');
        $('#req1pane4').css('display','none');
        $('#req1pane5').css('display','none');
        $('#req1pane6').css('display','block');
        $('#req1pane7').css('display','none');
    });
    $('#onboard-req-viewer-button7').click(function(){
        $('#req1pane1').css('display','none');
        $('#req1pane2').css('display','none');
        $('#req1pane3').css('display','none');
        $('#req1pane4').css('display','none');
        $('#req1pane5').css('display','none');
        $('#req1pane6').css('display','none');
        $('#req1pane7').css('display','block');
    });

}
// Sidebar Buttons
function SidebarButtons(){
    $('#hr_s1').click( function(event){
        $('#hr_p1').css('display','block');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr_s2').click( function(event){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','block');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr_s3').click( function(event){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','block');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr_s4').click( function(event){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','block');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr_s6').click( function(event){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','block');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr_s7').click( function(event){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','block');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr_s8').click( function(event){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','block');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr_s9').click( function(event){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','block');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr-s-ex1').click(function(){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','block');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr-s-ex2').click(function(){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','block');
        $('#employee-request-panel').css('display','none');
    });
    $('#hr-emp-req-sb').click(function(){
        $('#hr_p1').css('display','none');
        $('#hr_p2').css('display','none');
        $('#hr_p3').css('display','none');
        $('#hr_p4').css('display','none');
        $('#hr_p6').css('display','none');
        $('#hr_p7').css('display','none');
        $('#hr_p8').css('display','none');
        $('#hr_p9').css('display','none');
        $('#extra-panel1').css('display','none');
        $('#extra-panel2').css('display','none');
        $('#employee-request-panel').css('display','block');
    });
}
