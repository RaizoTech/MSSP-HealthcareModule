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
	<!-- Leave Request Modal -->
	<div id="leave-request-info" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-full modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Leave Approval - Basis Information</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-5">
							<div class="mb-3">
								<div class="card">
									<div class="card-body">
										<p class="fw-semibold">Employee Name</p><h4 id="emp_leave_name"></h5>
										<p class="fw-semibold">Leave Type</p><h4 id="emp_leave_type"></h5>
										<p class="fw-semibold">Start Date</p><h4 id="emp_leave_start"></h5>
										<p class="fw-semibold">End Date</p><h4 id="emp_leave_end"></h5>
										<p class="fw-semibold">Request Date</p><h4 id="emp_leaveReq_date"></h4>
										<hr>
										<button type="button" class="btn btn-primary" id="right-viewer-paneltoggle1">View Cover Letter</button>
										<button type="button" class="btn btn-primary" id="right-viewer-paneltoggle2">View Docs, Certs or Evidence</button>
										<hr>
										<button type="button" class="btn btn-success" id="right-viewer-paneltoggle1">Approved</button>
										<button type="button" class="btn btn-danger" id="right-viewer-paneltoggle1">Reject</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7">
							<div id="toggle-panel1">
								<div class="card" style="background:#fff;">
									<div id="cover-letter-emp" style="text-align: justify;color:#00246B;margin:2.1rem"></div>
								</div>
							</div>
							<div id="toggle-panel2">
								<div class="container">
								<div class="card" style="background:#fff;height:100%;">
									<div class="card-body sc">
										<h5 class="card-title">PDF Viewer</h5>
										<div id="pdf-viewer" style="width: 100%; height: 100%; position: relative;"></div>
      									<div id="controls" style="position: absolute; top: 10px; right: 10px;">
        									<button id="zoom-in" class="btn btn-primary">Zoom In</button>
        									<button id="zoom-out" class="btn btn-primary">Zoom Out</button>
      									</div>
									</div>
								</div>	
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal for Articles -->
	<!-- Add New Article -->
	<div id="article-addnew-m" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Article</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form id="add-new-article-form" method="POST" action="php_hw/add_article.php" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">Title:</label>
									<input type="text" name="new_article_title" class="form-control" placeholder="Example: Java Programming">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">Author:</label>
									<input type="text" name="new_article_author" class="form-control" placeholder="Example: James Gosling">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="mb-3">
									<label class="form-label">Content:</label>
									<textarea class="form-control" name="new_article_content" id="ckeditor_classic_prefilled" placeholder="Enter your text..."></textarea>
								</div>
							</div>
							<div class="col-lg-12">
								<label class="form-label">Profile Image:</label>
								<input type="file" name="profile_image_arc" class="file-input" data-show-preview="false">
							</div>
							<div class="col-lg-12">
								<label class="form-label">Content Image:</label>
								<input type="file" name="content_image_arc" class="file-input" data-show-preview="false">
							</div>
							<div class="col-lg-12">
								<div class="mb-3">
									<br>
									<button type="submit" class="btn btn-lg btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- View Article -->
	<div id="article-viewer-m" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal-title-viewer"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<center><img id="article-image-v" class="img-fluid" style="padding-right:2.3rem;padding-left:2.3rem;"></center>
					<br><br>
					<div class="container mb-3" id="arc-content-v" style="padding-right:2.3.rem;padding-left:2.3.rem;"></div>
					<br>
					<br>
					<p style="padding-right: 2.2rem;padding-left: 2.2rem;" id="arc-author-v"></p>
					<p style="padding-right: 2.2rem;padding-left: 2.2rem;" id="arc-datepost-v"></p>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- Edit Article -->
	<div id="article-editor-m" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Article Information</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form id="update-selected-article-form" method="POST" action="php_hw/update_article.php" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">Title:</label>
									<input type="hidden" name="update_id_article" id="edit-article-id">
									<input type="text" id="edit-article-title" name="update_new_article_title" class="form-control" placeholder="Example: Java Programming">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">Author:</label>
									<input type="text" id="edit-article-author" name="update_new_article_author" class="form-control" placeholder="Example: James Gosling">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="mb-3">
									<div class="container">
										<div class="btn-group">
											<button type="button" class="btn1 btn-primary" id="edit-alignLeft"><i class="fas fa-align-left"></i></button>
        									<button type="button" class="btn1 btn-primary" id="edit-alignCenter"><i class="fas fa-align-center"></i></button>
        									<button type="button" class="btn1 btn-primary" id="edit-alignRight"><i class="fas fa-align-right"></i></button>
        									<button type="button" class="btn1 btn-primary" id="edit-alignJustify"><i class="fas fa-align-justify"></i></button>
        									<button type="button" class="btn1 btn-primary" id="edit-alignDefault"><i class="fas fa-align-left"></i> Default</button>
										</div>
										<div class="btn-group">
											<button type="button" class="btn1 btn-primary" id="edit-indent"><i class="fas fa-indent"></i></button>
        									<button type="button" class="btn1 btn-primary" id="edit-outdent"><i class="fas fa-outdent"></i></button>
        									<button type="button" class="btn1 btn-primary" id="edit-leftIndent"><i class="fas fa-align-left"></i> Left Indent</button>
        									<button type="button" class="btn1 btn-primary" id="edit-rightIndent"><i class="fas fa-align-right"></i> Right Indent</button>
										</div>
										<div class="btn-group">
											<button type="button" class="btn1 btn-primary" id="edit-bulletedList"><i class="fas fa-list-ul"></i></button>
        									<button type="button" class="btn1 btn-primary" id="edit-numberedList"><i class="fas fa-list-ol"></i></button>
										</div>
										<div class="btn-group">
											<select class="form-select" id="edit-headingLevelSelect">
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
											<select class="form-select" id="edit-fontFamilySelect">
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
											<select id="edit-typeableSelect" class="form-select" aria-label="Default select example">
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
										<div id="editor1" contenteditable="true">
        									This is a sample text. Try editing it!
    									</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<label class="form-label">Profile Image:</label>
								<input type="file" name="update_profile_image_arc" id="updated-profile-image-arc" class="file-input" data-show-preview="false">
							</div>
							<div class="col-lg-12">
								<label class="form-label">Content Image:</label>
								<input type="file" name="update_content_image_arc" id="updated-content-image-arc" class="file-input" data-show-preview="false">
							</div>
							<div class="col-lg-12">
								<div class="mb-3">
									<br>
									<button type="submit" class="btn btn-lg btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- /Modal for Articles -->
	<!-- Modals for Programs -->
	<div id="program-addnew-m" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Program</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form id="add-new-program-form" method="POST" action="php_hw/add_program.php" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">Program Name:</label>
									<input type="text" id="program-name" name="new_program_name" class="form-control" placeholder="Example: Java Programming">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">Organizer:</label>
									<input type="text" id="program-organizer" name="new_program_organizer" class="form-control" placeholder="Example: James Gosling">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="mb-3">
									<div class="container">
										<div class="btn-group">
											<button type="button" class="btn1 btn-primary" id="alignLeft"><i class="fas fa-align-left"></i></button>
        									<button type="button" class="btn1 btn-primary" id="alignCenter"><i class="fas fa-align-center"></i></button>
        									<button type="button" class="btn1 btn-primary" id="alignRight"><i class="fas fa-align-right"></i></button>
        									<button type="button" class="btn1 btn-primary" id="alignJustify"><i class="fas fa-align-justify"></i></button>
        									<button type="button" class="btn1 btn-primary" id="alignDefault"><i class="fas fa-align-left"></i> Default</button>
										</div>
										<div class="btn-group">
											<button type="button" class="btn1 btn-primary" id="indent"><i class="fas fa-indent"></i></button>
        									<button type="button" class="btn1 btn-primary" id="outdent"><i class="fas fa-outdent"></i></button>
        									<button type="button" class="btn1 btn-primary" id="leftIndent"><i class="fas fa-align-left"></i> Left Indent</button>
        									<button type="button" class="btn1 btn-primary" id="rightIndent"><i class="fas fa-align-right"></i> Right Indent</button>
										</div>
										<div class="btn-group">
											<button type="button" class="btn1 btn-primary" id="bulletedList"><i class="fas fa-list-ul"></i></button>
        									<button type="button" class="btn1 btn-primary" id="numberedList"><i class="fas fa-list-ol"></i></button>
										</div>
										<div class="btn-group">
											<select class="form-select" id="headingLevelSelect">
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
											<select class="form-select" id="fontFamilySelect">
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
											<select id="typeableSelect" class="form-select" aria-label="Default select example">
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
										<div id="editor" contenteditable="true">
        									This is a sample text. Try editing it!
    									</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">Start Date:</label>
									<input type="text" class="form-control" name="start_progdate" id="datepicker1" placeholder="Select Date">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">End Date:</label>
									<input type="text" class="form-control" name="end_progdate" id="datepicker2" placeholder="Select Date">
								</div>
							</div>
							<div class="col-lg-12">
								<label class="form-label">Profile Image:</label>
								<input type="file" id="file-input1prog" name="profile_image_prog" class="file-input" data-show-preview="false">
							</div>
							<div class="col-lg-12">
								<label class="form-label">Content Image:</label>
								<input type="file" id="file-input2prog" name="content_image_prog" class="file-input" data-show-preview="false">
							</div>
							<div class="col-lg-12">
								<div class="mb-3">
									<br>
									<button type="submit" class="btn btn-lg btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- View Program Content -->
	<div id="program-viewer-m" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal-title-viewer-prog"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<center><img id="prog-image-v" class="img-fluid" style="padding-right:2.3rem;padding-left:2.3rem;"></center>
					<div class="container mb-3" id="prog-content-v" style="padding-right:2.3.rem;padding-left:2.3.rem;"></div>
					<br>
					<br>
					<p style="padding-right: 2.2rem;padding-left: 2.2rem;" id="prog-organizer-v"></p>
					<p style="padding-right: 2.2rem;padding-left: 2.2rem;" id="prog-datepost-v"></p>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- Add Counselling Service and Mentor User Credentials -->
	<div id="add-counselling-services" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Counselling Service & Mentor or Assign User Credential</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body" style="margin:30px">
					<form id="add-services-form" enctype="multipart/form-data">
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
						<hr>
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
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /View Program Content -->
	<!-- New Checkup Manual -->
	<div id="manual-checkup" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Employee</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="form-control-feedback form-control-feedback-start flex-grow-1">
    					<input type="text" id="searchInput" class="form-control bg-transparent rounded-pill" placeholder="Search Employee">
    					<div id="searchResults"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Set the manual checkup record -->
	<div id="checkup-manual-proceed" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header d-flex justify-content-between align-items-center">
					<h5 class="modal-title" id="employee-name-modal"></h5>
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manual-checkup">
						<i class="ph ph-swap"></i>
						Change Employee
					</button>
				</div>
				<div class="modal-body">
					<form id="manual-checkup-form">
						<div class="row">
							<!-- Set Action -->
							<div class="col-lg-6">
								<div class="card">
									<div class="card-body">
										<!-- Default input -->
										<input type="hidden" id="emp-code-form-input" name="emp_code">
										<div class="row mb-3">
											<label class="col-form-label col-lg-3">Checkup Type</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="check_up_type">
											</div>
										</div>
										<div class="row mb-3">
											<label class="col-form-label col-lg-3">Date</label>
											<div class="col-lg-9">
												<input class="form-control" type="date" name="date_checkup">
											</div>
										</div>
										<div class="row mb-3">
											<label class="col-form-label col-lg-3">Time</label>
											<div class="col-lg-9">
												<input class="form-control" type="time" name="time_checkup">
											</div>
										</div>
										<input type="hidden" value="Manual(Face2Face)" name="request_from">
										<button type="submit" class="btn btn-primary">
											<i class="ph ph-floppy-disk"></i>
											Save
										</button>
									</div>
								</div>
							</div>
							<!-- Employee Basic Information -->
							<div class="col-lg-6">
								<div class="card">
									<div class="card-body" id="result-employee-selected">
										<div class="row mb-3">
											<label class="col-form-label col-lg-3">Name: </label>
											<label class="col-form-label col-lg-3" id="fullname-emp">Name: </label>
										</div>
										<div class="row mb-3">
											<label class="col-form-label col-lg-3">Email: </label>
											<label class="col-form-label col-lg-3" id="email-emp">Email: </label>
										</div>
										<!--<div class="row mb-3">
											<label class="col-form-label col-lg-3">Department: </label>
											<label class="col-form-label col-lg-3">Department Name: </label>
										</div>
										<div class="row mb-3">
											<label class="col-form-label col-lg-3">Position: </label>
											<label class="col-form-label col-lg-3">Position: </label>
										</div>-->
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Update Checkup Record for ESS -->
	<div id="checkup-update-record" class="modal fade" tabindex="-1" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header d-flex justify-content-between align-items-center">
					<h5 class="modal-title">Checkup Online Appointment - Modify Request</h5>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">
						<i class="ph ph-x"></i>
					</button>
				</div>
				<div class="modal-body" style="max-height: 100vh; overflow-y: auto;">
					<form id="update-checkup-record-form">
						<div class="row">
							<div class="col-lg-6">
								<input type="hidden" id="employee-code-checkup" name="row_id_checkup_id">
								<div class="row mb-3">
									<label class="col-form-label col-lg-3">Note</label>
									<div class="col-lg-9">
										<textarea rows="3" cols="3" class="form-control" placeholder="Enter your message here" name="checkup_note"></textarea>
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-form-label col-lg-3">Status</label>
									<div class="col-lg-9">
										<select class="form-control select" data-minimum-results-for-search="Infinity" name="setstatus_checkup_record">
											<option value="" selected disabled>Set Status</option>
											<option value="Finished">Finished</option>
											<option value="Not Attend">Not Attend</option>
										</select>
									</div>
								</div>
								<button type="submit" class="btn btn-primary">
									<i class="ph ph-floppy-disk"></i>
									Save!
								</button>
							</div>
							<div class="col-lg-6">
								<div class="row mb-3">
									<label class="col-form-label col-lg-3">Name: </label>
									<label class="col-form-label" id="checkup-modification-fl">Name: </label>
								</div>
								<div class="row mb-3">
									<label class="col-form-label col-lg-3">Name: </label>
									<label class="col-form-label" id="checkup-modification-email">Email: </label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>