<?php

require_once 'php/config.php';
require 'php/user_credentials_fetch.php';
session_start();
$config = new config();
$connection = $config->getConnection();
$user_credentials = new UserCredentials();

if(isset($_SESSION['emp_id'])) {
	$id = $_SESSION['emp_id'];
	$user_data = array();
	$user_data = $user_credentials->EmployeeInformation($id);
	$sql = "
    SELECT 
		`wmain_job`.`name` 
	FROM 
		`work_ra_too`.`hr_jobs` AS `wmain_job` 
	INNER JOIN 
		`work_main_db`.`employees` AS `wmain_emp` 
	ON 
		`wmain_job`.`id` = `wmain_emp`.`job_role_id`  
    WHERE wmain_emp.`code`='$id'
    ";
	$result_finding = $connection->query($sql);
	$data_position = $result_finding->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Workfolio - MSS Portal</title>
	<!-- Global stylesheets -->
	<link href="assets1/fonts/inter/inter.css" rel="stylesheet" type="text/css">
	<link href="assets1/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/ltr/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
	<script src="assets1/js/jquery/jquery.min.js"></script>
	<link rel="icon" href="workfolio_hr_logo.png" type="image/png" />
	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script src="assets1/demo/demo_configurator.js"></script>
	<script src="assets1/js/bootstrap/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<!-- /core JS files -->
	<!-- Theme JS files -->
	<script src="assets1/js/vendor/visualization/d3/d3.min.js"></script>
	<script src="assets1/js/vendor/visualization/d3/d3_tooltip.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	<script src="assets/js/app.js"></script>
	<script src="assets1/demo/pages/dashboard.js"></script>
	<script src="assets1/demo/charts/pages/dashboard/streamgraph.js"></script>
	<script src="assets1/demo/charts/pages/dashboard/sparklines.js"></script>
	<script src="assets1/demo/charts/pages/dashboard/lines.js"></script>	
	<script src="assets1/demo/charts/pages/dashboard/areas.js"></script>
	<script src="assets1/demo/charts/pages/dashboard/donuts.js"></script>
	<script src="assets1/demo/charts/pages/dashboard/bars.js"></script>
	<script src="assets1/demo/charts/pages/dashboard/progress.js"></script>
	<script src="assets1/demo/charts/pages/dashboard/heatmaps.js"></script>
	<script src="assets1/demo/charts/pages/dashboard/pies.js"></script>
	<script src="assets1/demo/charts/pages/dashboard/bullets.js"></script>
	<!-- Datatables -->
	<!-- Form Wizard shit -->
	<script src="assets1/js/vendor/forms/wizards/steps.min.js"></script>
	<script src="assets1/js/vendor/forms/validation/validate.min.js"></script>
	<script src="assets1/demo/pages/form_wizard.js"></script>
	<!-- /Form wizard shit -->
	<!-- Include DataTables JS -->
	<script src="assets1/demo/pages/datatables_data_sources.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<script src="assets/js/app.js"></script>
	<!-- /theme JS files -->
	<script src="assets1/js/vendor/notifications/noty.min.js"></script>
	<script src="assets1/demo/pages/extra_noty.js"></script>
	<script src="assets1/js/vendor/notifications/sweet_alert.min.js"></script>
	<!-- For PDF Viewer -->
	<!-- PDF.js library -->
	<script src="assets1/js/vendor/forms/selects/select2.min.js"></script>
	<script src="assets1/demo/pages/form_select2.js"></script>
	<!-- PDF.js library -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
	<!-- /For PDF Viewer -->
	<!-- File Uploader -->
	<script src="assets1/js/vendor/uploaders/fileinput/fileinput.min.js"></script>
	<script src="assets1/js/vendor/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="assets1/demo/pages/uploader_bootstrap.js"></script>
	<!-- /File Uploader -->
	<script src="assets1/js/vendor/extensions/session_timeout.min.js"></script>
	<!--<script src="assets1/demo/pages/extra_session_timeout.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<!-- Text Editor -->
	<!-- Include CKEditor library -->
	<script src="assets1/js/vendor/editors/ckeditor/ckeditor_classic.js"></script>
	<script src="assets1/demo/pages/editor_ckeditor_classic.js"></script>
	<?php
	if($data_position['name'] === 'HR Manager') { ?><script src="assets1/js/hr_final.js"></script><?php } 
	if($data_position['name'] === 'Executive General Manager' || $data_position['name'] === 'Senior Manager') { ?><script src="assets1/js/user2.js"></script><?php }
	if($data_position['name'] === 'Healthcare Administrator') { ?><script src="assets1/js/hw_final_remake.js"></script><?php }
	if($data_position['name'] === 'Healthcare Provider') { ?><script src="assets1/js/user4.js"></script><?php }
	?>
</head>
<body>
	<!-- Main navbar -->
	<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
		<div class="container-fluid">
			<div class="d-flex d-lg-none me-2">
				<button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
					<i class="ph-list"></i>
				</button>
			</div>

			<div class="navbar-brand flex-1 flex-lg-0">
				<a href="index.php" class="d-inline-flex align-items-center">
					<img src="workfolio_hr_logo.png" alt="">
					<div class="d-none d-lg-inline-block h-20px ms-3" style="font-size:17px;font-weight:bold;color:#f1f1f1;">Workfolio - Manager Self-Service Portal</div>
				</a>
			</div>

			<ul class="nav flex-row justify-content-end order-1 order-lg-2">

				<li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
					<a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
						<div class="status-indicator-container">
							<img src="assets1/images/demo/users/face11.jpg" class="w-32px h-32px rounded-pill" alt="">
							<span class="status-indicator bg-success"></span>
						</div>
						<span class="d-none d-lg-inline-block mx-lg-2"><?php echo $user_data['first_name'].' '.$user_data['last_name']; ?></span>
					</a>

					<div class="dropdown-menu dropdown-menu-end">
						<span class="d-none d-lg-inline-block mx-lg-2"><?php echo $data_position['name']; ?></span>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="ph-gear me-2"></i>
							Account settings
						</a>
						<a href="logout.php" class="dropdown-item">
							<i class="ph-sign-out me-2"></i>
							Logout
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /Main navbar -->
	<!-- Page Content -->
	<div class="page-content">
		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
			<!-- Sidebar content -->
			<div class="sidebar-content">
				<!-- Sidebar header -->
				<div class="sidebar-section">
					<div class="sidebar-section-body d-flex justify-content-center">
						<div>
							<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
								<i class="ph-arrows-left-right"></i>
							</button>
							<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
								<i class="ph-x"></i>
							</button>
						</div>
					</div>
				</div>
				<!-- /sidebar header -->
				<!-- Main navigation -->
				<div class="sidebar-section">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
						<!-- Main -->
						<li class="nav-item-header pt-0">
							<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main Menu</div>
							<i class="ph-dots-three sidebar-resize-show"></i>
						</li>
						<?php require 'sidebar.php' ?>
						<!-- /page kits -->
					</ul>
				</div>
				<!-- /main navigation -->
			</div>
			<!-- /sidebar content -->
		</div>
		<!-- /main sidebar -->
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Inner content -->
			<div class="content-inner">
				<!-- Content -->
				<div class="content">
					<?php
					if($data_position['name'] === 'HR Manager'){
						require 'content1.php';
					}
					if($data_position['name'] === 'Executive General Manager' || $data_position['name'] === 'Senior Manager'){
						require 'content2.php';
					}
					if($data_position['name'] === 'Healthcare Administrator'){
						require 'content3.php';
					}
					if($data_position['name'] === 'Healthcare Provider'){
						require 'content4.php';
					}
					?>
					<div id="account-settings-section">
						
					</div>
				</div>
				<!-- /Content -->
				<!-- Footer -->
				<div class="navbar navbar-sm navbar-footer border-top">
					<div class="container-fluid">
						<span>&copy; 2024 <a href="https://chcs.workfoliohumanresource.com/">Workfolio Manager Self Service Portal</a></span>
					</div>
				</div>
				<!-- /footer -->
			</div>
			<!-- /Inner content -->
		</div>
		<!-- /Main content -->
	</div>
	<!--/Page Content -->
	<!-- Modals -->
	<!-- Full width modal -->
	<div id="employee-info-stat" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-full modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Employee Information & Statistics</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-lg-4">
							<div class="card">
								<div class="card-body">
									<center>
										<img id="emp_image" class="img-fluid">
									</center>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="card" style="width: 100%;">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<p class="fw-semibold">Name</p><h5 id="name_eism"></h5>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<p class="fw-semibold">Date of birth</p><h5 id="dob_eism"></h5>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="mb-3">
												<p class="fw-semibold">Age</p><h5 id="age_eism"></h5>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="mb-3">
												<p class="fw-semibold">Gender</p><h5 id="gender_eism"></h5>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="mb-3">
												<p class="fw-semibold">Civil Status</p><h5 id="civil_status_eism"></h5>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<p class="fw-semibold">Place of birth</p><h5 id="placebirth_eism"></h5>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<p class="fw-semibold">Email</p><h5 id="email_eism"></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card" style="width: 100%;">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-lg-6">
											<div class="mb-3">
												<p class="fw-semibold">Department</p><h5 id="department_eism"></h5>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<p class="fw-semibold">Position</p><h5 id="position_eism"></h5>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<p class="fw-semibold">Work Type</p><h5 id="worktype_eism"></h5>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<p class="fw-semibold">Actions</p>
												<button type="button" class="btn btn-primary"><i class="ph-fill ph-percent"></i>View Performance</button>
												<button type="button" class="btn btn-success"><i class="ph ph-files"></i>View Documents</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card" style="width:100%">
						<div class="card-header">
							<h5 id="act-name-eism" class="mb-0"></h5>
						</div>
						<div class="card-body">
							<div class="table-responsive table-scrollable border-top">
								<table id="activity-logs-emp-eism" class="table" style="width:100%">
									<thead>
										<tr>
            								<th>Date & Time</th>
            								<th>View Details</th>
										</tr>
									</thead>
									<tbody>
        								<!-- Table body will be populated dynamically -->
    								</tbody>
								</table>
							</div>
						</div>
						<!-- This is the message to display when there are no activity logs -->
						<div id="no-activity-message" style="display: none;">
    						<center><h2>No activity committed yet!</h2></center>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modals -->
	<?php 
	if($data_position['name'] === 'HR Manager'){
		require 'modals/hr_modals.php';
	}
	if($data_position['name'] === 'Executive General Manager' || $data_position['name'] === 'Senior Manager') {
		require 'modals/egm_sm.php';
	} 
	if($data_position['name'] === 'Healthcare Administrator'){
		require 'modals/HA.php';
	}
	if($data_position['name'] === 'Healthcare Provider'){
		require 'modals/HP.php';
	}
	?>
	<!-- Leave Request Modal -->
	<!-- Add Counselling Service and Mentor User Credentials -->
	<div id="add-counselling-services" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Counselling Service & Mentor or Assign User Credential</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form id="add-services-form" class="wizard-form" method="POST" action="php_/add_services_mentor_credential.php" enctype="multipart/form-data">
						<!-- Counselling Service -->
						<h6>Counselling Service</h6>
						<fieldset>
							<div class="row">
								<div class="col-lg-12">
									<div class="mb-3">
										<label class="form-label">Service name:</label>
										<input type="text" name="new_service_name" id="new-service-name" class="form-control" placeholder="Service Name">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3">
										<label class="form-label">Address:</label>
										<input type="text" name="new_address" id="new-address" class="form-control" placeholder="Address">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3">
										<label class="form-label">Description</label>
										<div class="container">
											<div class="btn-group">
												<button type="button" class="btn1 btn-primary" id="services-alignLeft"><i class="fas fa-align-left"></i></button>
        										<button type="button" class="btn1 btn-primary" id="services-alignCenter"><i class="fas fa-align-center"></i></button>
        										<button type="button" class="btn1 btn-primary" id="services-alignRight"><i class="fas fa-align-right"></i></button>
        										<button type="button" class="btn1 btn-primary" id="services-alignJustify"><i class="fas fa-align-justify"></i></button>
        										<button type="button" class="btn1 btn-primary" id="services-alignDefault"><i class="fas fa-align-left"></i> Default</button>
											</div>
											<div class="btn-group">
												<button type="button" class="btn1 btn-primary" id="services-indent"><i class="fas fa-indent"></i></button>
        										<button type="button" class="btn1 btn-primary" id="services-outdent"><i class="fas fa-outdent"></i></button>
        										<button type="button" class="btn1 btn-primary" id="services-leftIndent"><i class="fas fa-align-left"></i> Left Indent</button>
        										<button type="button" class="btn1 btn-primary" id="services-rightIndent"><i class="fas fa-align-right"></i> Right Indent</button>
											</div>
											<div class="btn-group">
												<button type="button" class="btn1 btn-primary" id="services-bulletedList"><i class="fas fa-list-ul"></i></button>
        										<button type="button" class="btn1 btn-primary" id="services-numberedList"><i class="fas fa-list-ol"></i></button>
											</div>
											<div class="btn-group">
												<select class="form-select" id="services-headingLevelSelect">
    												<option value="p">Paragraph</option>
    												<option value="h1">Heading 1</option>
    												<option value="h2">Heading 2</option>
    												<option value="h3">Heading 3</option>
    												<option value="h4">Heading 4</option>
    												<option value="h5">Heading 5</option>
    												<option value="h6">Heading 6</option>
												</select>
											</div>
											<div class="btn-group">
												<select class="form-select" id="services-fontFamilySelect">
    												<option value="Arial, sans-serif">Arial</option>
    												<option value="Verdana, sans-serif">Verdana</option>
    												<option value="Tahoma, sans-serif">Tahoma</option>
    												<option value="Georgia, serif">Georgia</option>
    												<option value="Times New Roman, serif">Times New Roman</option>
    												<option value="Courier New, monospace">Courier New</option>
    												<option value="Lucida Console, monospace">Lucida Console</option>
    												<option value="Helvetica, sans-serif">Helvetica</option>
    												<option value="Calibri, sans-serif">Calibri</option>
    												<option value="Roboto, sans-serif">Roboto</option>
    												<option value="Open Sans, sans-serif">Open Sans</option>
    												<option value="Palatino, serif">Palatino</option>
    												<option value="Garamond, serif">Garamond</option>
    												<option value="Book Antiqua, serif">Book Antiqua</option>
    												<option value="Arial Black, sans-serif">Arial Black</option>
    												<option value="Impact, sans-serif">Impact</option>
    												<option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
    												<option value="Century Gothic, sans-serif">Century Gothic</option>
    												<option value="Geneva, sans-serif">Geneva</option>
    												<option value="Comic Sans MS, cursive">Comic Sans MS</option>
												</select>
											</div>
											<div class="btn-group">
												<select id="services-typeableSelect" class="form-select" aria-label="Default select example">
            										<option value="1">1px</option>
            										<option value="2">2px</option>
            										<option value="3">3px</option>
            										<option value="4">4px</option>
            										<option value="5">5px</option>
            										<option value="6">6px</option>
            										<option value="7">7px</option>
            										<option value="8">8px</option>
            										<option value="9">9px</option>
            										<option value="10">10px</option>
            										<option value="11">11px</option>
            										<option value="12">12px</option>
            										<option value="13">13px</option>
            										<option value="14">14px</option>
            										<option value="16">16px</option>
            										<option value="18">18px</option>
            										<option value="35">35px</option>
            										<option value="50">50px</option>
            										<option value="70">70px</option>
            										<option value="100">100px</option>
        										</select>
											</div>
										</div>
										<div id="editor-serviceshit" contenteditable="true">
        									This is a sample text. Try editing it!
    									</div>
    								</div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Service Logo:</label>
										<input type="file" name="service_logo" id="img-service-logo" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Contact:</label>
										<input type="text" name="new_service_contact" id="new-service-contact" class="form-control" placeholder="Contact">
									</div>
								</div>
							</div>
						</fieldset>
						<!-- Counselling Mentor -->
						<h6>Counselling Mentor User Credential Creation</h6>
						<fieldset>
							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">First Name:</label>
										<input type="text" name="first_name_mentor" id="first-name-mentor" class="form-control" placeholder="First Name">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Last Name:</label>
										<input type="text" name="last_name_mentor" id="last-name-mentor" class="form-control" placeholder="Last Name">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3">
										<label class="form-label">Email Address:</label>
										<input type="email" name="email_mentor" id="email-mentor" class="form-control" placeholder="your@email.com">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3">
										<label class="form-label">Username:</label>
										<input type="text" name="username_mentor" id="username-mentor" class="form-control" placeholder="Username">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3">
										<label class="form-label">Password:</label>
										<input type="password" name="password_mentor" id="password-mentor" class="form-control" placeholder="Password">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3">
										<label class="form-label">IMG:</label>
										<input type="file" name="img_mentor" id="img-mentor" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /View Program Content -->
	<!-- /Modals for Programs -->
	<script type="text/javascript">
		$(document).ready(function() {
			// Function to update the hidden input with the content of the contenteditable div
			//function updateHiddenInput() {
    			//var editorContent = $('#editor1').html();
    			//$('#new-updated-content-article').val(editorContent);
			//}

			// Add event listeners to the contenteditable div to detect changes
			//$('#editor1').on('input', function() {
    			// Update the hidden input whenever the contenteditable div is modified
    			//updateHiddenInput();
			//});

			// Optionally, you may also update the hidden input when the contenteditable div loses focus
			//$('#editor1').on('blur', function() {
    			// Update the hidden input when the contenteditable div loses focus
    			//updateHiddenInput();
			//});

    		// Event listener for clicks outside the editor
    		$('#alignLeft').click(function() {
        		document.execCommand('justifyLeft', false, null);
    		});
    		$('#alignCenter').click(function() {
        		document.execCommand('justifyCenter', false, null);
    		});
    		$('#alignRight').click(function() {
        		document.execCommand('justifyRight', false, null);
    		});
    		$('#alignJustify').click(function() {
        		document.execCommand('justifyFull', false, null);
    		});
    		$('#alignDefault').click(function() {
        		document.execCommand('justifyLeft', false, null); // Reset to default
    		});
    		$('#indent').click(function() {
        		document.execCommand('indent', false, '5px');
    		});
    		$('#outdent').click(function() {
        		document.execCommand('outdent', false, '');
    		});
    		$('#leftIndent').click(function() {
        		$('#editor').css('text-indent', '20px'); // Adjust the value as needed
    		});
    		$('#rightIndent').click(function() {
        		$('#editor').css('text-indent', '-20px'); // Adjust the value as needed
    		});
    		$('#bulletedList').click(function() {
        		document.execCommand('insertUnorderedList', false, null);
    		});
    		$('#numberedList').click(function() {
        		document.execCommand('insertOrderedList', false, null);
    		});
    		$('#headingLevelSelect').change(function() {
        		var selectedHeading = $(this).val();
        		document.execCommand('formatBlock', false, selectedHeading);
    		});
    		$('#fontFamilySelect').change(function() {
        		var selectedFontFamily = $(this).val();
        		document.execCommand('fontName', false, selectedFontFamily);
    		});
    		$('#typeableSelect').change(function(){
        		var fontSize = $(this).val();
        		document.execCommand('fontSize', false, fontSize);
    		});
    		// Event listener for clicks outside the editor
    		$('#edit-alignLeft').click(function() {
        		document.execCommand('justifyLeft', false, null);
    		});
    		$('#edit-alignCenter').click(function() {
        		document.execCommand('justifyCenter', false, null);
    		});
    		$('#edit-alignRight').click(function() {
        		document.execCommand('justifyRight', false, null);
    		});
    		$('#edit-alignJustify').click(function() {
        		document.execCommand('justifyFull', false, null);
    		});
    		$('#edit-alignDefault').click(function() {
        		document.execCommand('justifyLeft', false, null); // Reset to default
    		});
    		$('#edit-indent').click(function() {
        		document.execCommand('indent', false, '10px');
    		});
    		$('#edit-outdent').click(function() {
        		document.execCommand('outdent', false, '');
    		});
    		$('#edit-leftIndent').click(function() {
        		$('#editor').css('text-indent', '20px'); // Adju
    		});
    		$('#edit-rightIndent').click(function() {
        		$('#editor').css('text-indent', '-20px'); // Adjust the value as needed
    		});
    		$('#edit-bulletedList').click(function() {
        		document.execCommand('insertUnorderedList', false, null);
    		});
    		$('#edit-numberedList').click(function() {
        		document.execCommand('insertOrderedList', false, null);
    		});
    		$('#edit-headingLevelSelect').change(function() {
        		var selectedHeading = $(this).val();
        		document.execCommand('formatBlock', false, selectedHeading);
    		});
    		$('#edit-fontFamilySelect').change(function() {
        		var selectedFontFamily = $(this).val();
        		document.execCommand('fontName', false, selectedFontFamily);
    		});
    		$('#edit-typeableSelect').change(function(){
        		var fontSize = $(this).val();
        		document.execCommand('fontSize', false, fontSize);
    		});
    		// Services
    		// Event listener for clicks outside the editor
    		$('#services-alignLeft').click(function() {
        		document.execCommand('justifyLeft', false, null);
    		});
    		$('#services-alignCenter').click(function() {
        		document.execCommand('justifyCenter', false, null);
    		});
    		$('#services-alignRight').click(function() {
        		document.execCommand('justifyRight', false, null);
    		});
    		$('#services-alignJustify').click(function() {
        		document.execCommand('justifyFull', false, null);
    		});
    		$('#services-alignDefault').click(function() {
        		document.execCommand('justifyLeft', false, null); // Reset to default
    		});
    		$('#services-indent').click(function() {
        		document.execCommand('indent', false, '5px');
    		});
    		$('#services-outdent').click(function() {
        		document.execCommand('outdent', false, '');
    		});
    		$('#services-leftIndent').click(function() {
        		$('#editor').css('text-indent', '20px'); // Adjust the value as needed
    		});
    		$('#services-rightIndent').click(function() {
        		$('#editor').css('text-indent', '-20px'); // Adjust the value as needed
    		});
    		$('#services-bulletedList').click(function() {
        		document.execCommand('insertUnorderedList', false, null);
    		});
    		$('#services-numberedList').click(function() {
        		document.execCommand('insertOrderedList', false, null);
    		});
    		$('#services-headingLevelSelect').change(function() {
        		var selectedHeading = $(this).val();
        		document.execCommand('formatBlock', false, selectedHeading);
    		});
    		$('#services-fontFamilySelect').change(function() {
        		var selectedFontFamily = $(this).val();
        		document.execCommand('fontName', false, selectedFontFamily);
    		});
    		$('#services-typeableSelect').change(function(){
        		var fontSize = $(this).val();
        		document.execCommand('fontSize', false, fontSize);
    		});
		});
	</script>
	<style>
    	#editor {
        	width: 100%;
        	min-height: 300px;
        	border: 1px solid #ccc;
        	padding: 10px;
        	margin: 20px 0;
    	}
    	.btn-group1 {
        	margin-bottom: 10px;
    	}
    	.btn1 {
        	padding: 10px 20px;
        	cursor: pointer;
        	margin: 0 5px 5px 0;
        	background-color: #f8f9fa;
        	color: #343a40;
        	border: 1px solid #ced4da;
    	}
    	.btn1:hover {
        	background-color: #e9ecef;
        	color: #343a40;
    	}
    	#editor1 {
        	width: 100%;
        	min-height: 300px;
        	border: 1px solid #ccc;
       	 	padding: 10px;
        	margin: 20px 0;
    	}
    	#editor-serviceshit {
        	width: 100%;
        	min-height: 100px;
        	border: 1px solid #ccc;
        	padding: 10px;
        	margin: 20px 0;
    	}
    	.btn-group1 {
        	margin-bottom: 10px;
    	}
    	.btn1 {
        	padding: 10px 20px;
        	cursor: pointer;
        	margin: 0 5px 5px 0;
        	background-color: #f8f9fa;
        	color: #343a40;
        	border: 1px solid #ced4da;
    	}
    	.btn1:hover {
        	background-color: #e9ecef;
        	color: #343a40;
    	}
	</style>
</body>
</html>

<?php
}
else {
	header('Location: index.php');
	exit();
}

?>