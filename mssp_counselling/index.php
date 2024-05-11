<?php

require_once 'php/config.php';
require 'php/counselling_mentor_credentials.php';
session_start();
// Database connection
$config = new config();
$connection = $config->getConnection();
// Retrieving Mentor Credentials after login
$mentor_credentials = new CounsellingMentorCredentials();
$mentor_data = array();
$mentor_data = $mentor_credentials->ConsellingMentorInformation($_SESSION['cm_id']);

if (isset($_SESSION['cm_id']) && isset($_SESSION['service_id'])) {
	$id = $mentor_data['service_id'];
	$_SESSION['service_identifier'] = $mentor_data['service_id'];
	$sql = "SELECT * FROM counselling_service WHERE service_id='$id'";
	$result = $connection->query($sql);
	$service_name = $result->fetch_assoc();
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Workfolio - MSS Portal</title>
	<!-- Global stylesheets -->
	<link href="../assets1/fonts/inter/inter.css" rel="stylesheet" type="text/css">
	<link href="../assets1/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/ltr/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
	<script src="../assets1/js/jquery/jquery.min.js"></script>
	<link rel="icon" href="../workfolio_hr_logo.png" type="image/png" />
	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script src="../assets1/demo/demo_configurator.js"></script>
	<script src="../assets1/js/bootstrap/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<!-- /core JS files -->
	<!-- Theme JS files -->
	<script src="../assets1/js/vendor/visualization/d3/d3.min.js"></script>
	<script src="../assets1/js/vendor/visualization/d3/d3_tooltip.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	<script src="../assets/js/app.js"></script>
	<script src="../assets1/demo/pages/dashboard.js"></script>
	<script src="../assets1/demo/charts/pages/dashboard/streamgraph.js"></script>
	<script src="../assets1/demo/charts/pages/dashboard/sparklines.js"></script>
	<script src="../assets1/demo/charts/pages/dashboard/lines.js"></script>	
	<script src="../assets1/demo/charts/pages/dashboard/areas.js"></script>
	<script src="../assets1/demo/charts/pages/dashboard/donuts.js"></script>
	<script src="../assets1/demo/charts/pages/dashboard/bars.js"></script>
	<script src="../assets1/demo/charts/pages/dashboard/progress.js"></script>
	<script src="../assets1/demo/charts/pages/dashboard/heatmaps.js"></script>
	<script src="../assets1/demo/charts/pages/dashboard/pies.js"></script>
	<script src="../assets1/demo/charts/pages/dashboard/bullets.js"></script>
	<!-- Datatables -->
	<!-- Form Wizard shit -->
	<script src="../assets1/js/vendor/forms/wizards/steps.min.js"></script>
	<script src="../assets1/js/vendor/forms/validation/validate.min.js"></script>
	<script src="../assets1/demo/pages/form_wizard.js"></script>
	<!-- /Form wizard shit -->
	<!-- Include DataTables JS -->
	<script src="../assets1/demo/pages/datatables_data_sources.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<script src="../assets/js/app.js"></script>
	<!-- /theme JS files -->
	<script src="../assets1/js/vendor/notifications/noty.min.js"></script>
	<script src="../assets1/demo/pages/extra_noty.js"></script>
	<script src="../assets1/js/vendor/notifications/sweet_alert.min.js"></script>
	<!-- For PDF Viewer -->
	<!-- PDF.js library -->
	<!-- PDF.js library -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
	<!-- /For PDF Viewer -->
	<!-- File Uploader -->
	<script src="../assets1/js/vendor/uploaders/fileinput/fileinput.min.js"></script>
	<script src="../assets1/js/vendor/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="../assets1/demo/pages/uploader_bootstrap.js"></script>
	<!-- /File Uploader -->
	<script src="../assets1/js/vendor/extensions/session_timeout.min.js"></script>
	<!--<script src="assets1/demo/pages/extra_session_timeout.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<!-- Text Editor -->
	<!-- Include CKEditor library -->
	<script src="../assets1/js/vendor/editors/ckeditor/ckeditor_classic.js"></script>
	<script src="../assets1/demo/pages/editor_ckeditor_classic.js"></script>
	<script src="js/mentor.js"></script>
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
					<img src="../workfolio_hr_logo.png" alt="">
					<div class="d-none d-lg-inline-block h-20px ms-3" style="font-size:17px;font-weight:bold;color:#f1f1f1;">Workfolio - Counselling</div>
				</a>
			</div>

			<ul class="nav flex-row justify-content-end order-1 order-lg-2">

				<li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
					<a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
						<div class="status-indicator-container">
							<img src="../assets1/images/demo/users/face11.jpg" class="w-32px h-32px rounded-pill" alt="">
							<span class="status-indicator bg-success"></span>
						</div>
						<span class="d-none d-lg-inline-block mx-lg-2"><?php echo $mentor_data['first_name'].' '.$mentor_data['last_name']; ?></span>
					</a>

					<div class="dropdown-menu dropdown-menu-end">
						<div class="container">
							<div class="mb-3"><?php echo $service_name['service_name'] ?></div>
							
						</div>
						
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item" id="account-set-sb">
							<i class="ph-gear me-2"></i>
							Account settings
						</a>
						<a href="php/logout.php" class="dropdown-item">
							<i class="ph-sign-out me-2"></i>
							Logout
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /Main navbar -->
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
						<li class="nav-item">
							<a href="#" id="mentor-sb1" class="nav-link">
								<i class="ph-house"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="mentor-sb2" class="nav-link">
								<i class="ph-fill ph-users-four"></i>
								<span>Appointments</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="mentor-sb3" class="nav-link">
								<i class="ph-fill ph-sign-out"></i>
								<span>Schedules</span>
							</a>
						</li>
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
					<div id="mentor-panel1">
						<div class="row">
							<div class="col-lg-6">
								<!-- Members online -->
								<div class="card bg-teal text-white">
									<div class="card-body">
										<div class="d-flex">
											<h3 id="total-appointments" class="mb-0"></h3>
											<div class="dropdown d-inline-flex ms-auto">
												<a href="#" class="text-white d-inline-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
													<i class="ph-gear"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-end">
													<a href="#" class="dropdown-item">
														<script type="text/javascript">
														</script>
														<i class="ph-list-dashes me-2"></i>
													</a>
												</div>
											</div>
										</div>
										<div>
											Appointments Total
											<div class="fs-sm opacity-75"></div>
										</div>
									</div>
									<div class="rounded-bottom overflow-hidden mx-3" id="members-online"></div>
								</div>
								<!-- /members online -->
							</div>
							<div class="col-lg-6">
								<div class="card bg-primary text-white">
									<div class="card-body">
										<div class="d-flex align-items-center">
											<h3 id="total-appointments-f" class="mb-0"></h3>
											<div class="dropdown d-inline-flex ms-auto">
												<a href="#" class="text-white d-inline-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
													<i class="ph-gear"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-end">
													<a href="#" class="dropdown-item">
														<i class="ph-list-dashes me-2"></i>
														Detailed log
													</a>
												</div>
											</div>
										</div>
										<div>
											Appointment Finished
										</div>
									</div>
									<div class="rounded-bottom overflow-hidden" id="server-load"></div>
								</div>
							</div>
						</div>
					</div>
					<div id="mentor-panel2">
						<div class="card">
							<div class="card-header">
								<h5 class="mb-0">Appointments</h5>
							</div>
							<div class="card-body">
								<button type="button" id="appointment-subB1" class="btn btn-primary">All Appointments list</button>
								<button type="button" id="appointment-subB2" class="btn btn-primary">Today's Appointments</button>
							</div>
							<div id="all-appointments">
								<table id="appointment-table" class="table datatable-selection-single" style="width:100%">
									<thead>
										<tr>
											<th>Name</th>
											<th>Department</th>
											<th>Position</th>
											<th>Date Time</th>
											<th class="text-center">Actions</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div id="today-appointments">
								<table id="appointment-today-table" class="table datatable-selection-single" style="width:100%">
									<thead>
										<tr>
											<th>Name</th>
											<th>Department</th>
											<th>Position</th>
											<th>Date Time</th>
											<th class="text-center">Actions</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div id="mentor-panel3">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Schedules Available</h5>
							</div>
							<div class="card-body">
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#set-schedule">Set Schedule</button>
								<hr>
								<div class="row" id="schedules-set">
									
								</div>
							</div>
						</div>
					</div>
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
	<!-- Modal Set Schedules -->
	<div id="set-schedule" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Set Schedule</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form id="add-schedule-form" method="POST" action="php/.php">
						<button type="button" class="btn btn-secondary" id="addDateTime">Add More Date & Time</button>
						<button type="button" class="btn btn-danger" id="deleteAllFields">Delete All</button>
						<div id="dynamicFields">
							<!-- Additional Field Appear here -->
            			</div>
            			<br>
            			<!-- Submit button -->
            			<button type="button" class="btn btn-primary" id="submitData">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Edit Schedule -->
	<div id="edit-schedule" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="edit-sched-title"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form id="edit-schedule-selected" method="POST">
						<input type="hidden" id="sequence-id-sched" name="sequence_id">
						<div class="row">
							<div class="col-md-4">
                    			<div class="form-group">
                        			<label for="date">Date:</label>
                        			<input type="date" class="form-control" id="edit-dateset" name="edit_dateset" />
                    			</div>
                			</div>
                			<div class="col-md-3">
                    			<div class="form-group">
                        			<label for="time">Time AM</label>
                        			<input type="time" class="form-control" id="edit-timeAM" name="edit_timeAM" />
                    			</div>
                			</div>
                			<div class="col-md-3">
                    			<div class="form-group">
                        			<label for="time">Time PM</label>
                        			<input type="time" class="form-control" id="edit-timePM" name="edit_timePM" />
                    			</div>
                			</div>
                			<div class="col-md-2">
                    			<div class="form-group">
                        			<label for="time">Slot Limit:</label>
                        			<select class="form-select" id="edit-slot" name="edit_slot" aria-label="Default select example">
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
						</div>
						<br>
						<button type="button" class="btn btn-success" id="submitDataSaveSchedule">Save</button>
						<button type="button" class="btn btn-danger" id="submitDataCancel">Cancel Schedule</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Counselling -->
	<div id="counselling-view-modal" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Counselling</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-5">
							<div class="card">
								<ul class="list-group list-group-flush border-top">
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Name: </span>
										<div class="ms-auto" id="cad-emp-name"></div>
									</li>
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Work Position: </span>
										<div class="ms-auto" id="cad-emp-position"></div>
									</li>
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Department: </span>
										<div class="ms-auto" id="cad-emp-department"></div>
									</li>
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Age: </span>
										<div class="ms-auto" id="cad-emp-age"></div>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="card">
								<div class="card-body">
									<div id="first-action-panel1">
										<form id="setActionCounselling1">
											<input type="hidden" id="counselling-id" name="counselling_id">
											<button type="button" id="counselling-action1" class="btn btn-primary">Start Counselling?</button>
											<button type="button" id="counselling-action2" class="btn btn-danger">Set Not Attend</button>
										</form>
									</div>
									<div id="second-action-panel2" style="display:none">
										<form id="setActionCounselling2">
											<input type="hidden" id="counselling-id2" name="counselling_id">
											<button type="button" id="counselling-action3" class="btn btn-danger">Finish Counselling</button>
										</form>
									</div>
									<div id="note-submission" style="display:none">
										<form id="note-submission-form">
											<input type="hidden" id="counselling-id3" name="counselling_id">
											<textarea name="note_appointment">
												text here
											</textarea>
											<button type="button" id="counselling-action4" class="btn btn-primary">Submit</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php
}
else{
	header('Location: login_page.php');
	exit();
}
?>