<!-- View Information Details -->
<div id="modal-emp-information" class="modal fade" tabindex="-1" data-bs-backdrop="static">
	<div class="modal-dialog modal-full modal-dialog-scrollable modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Employee Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<!--<div class="container">-->
					<div class="row">
						<div class="col-lg-4">
							<div class="mb-3">
								<div class="card">
									<div class="card-header bg-dark text-white">
										<h5 class="card-title" id="ei-name"></h5>
									</div>
									<ul class="list-group list-group-flush border-top">
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Work Status:</span>
											<div class="ms-auto" id="ei-work-status"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Position:</span>
											<div class="ms-auto" id="ei-position"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Department:</span>
											<div class="ms-auto" id="ei-department"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Email:</span>
											<div class="ms-auto" id="ei-email"></div>
										</li>
										<!-- -->
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Date of Birth:</span>
											<div class="ms-auto" id="ei-dob"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Age:</span>
											<div class="ms-auto" id="ei-age"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Place Birth:</span>
											<div class="ms-auto" id="ei-placebirth"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Gender:</span>
											<div class="ms-auto" id="ei-gender"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Civil Status:</span>
											<div class="ms-auto" id="ei-civil-status"></div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="mb-3">
								<div class="card">
									<div class="card-header bg-dark text-white">
										<h5 class="card-title">Attendance All Records</h5>
										<button type="button" class="btn btn-primary" id="refresh-indiv-attendance-table">Refresh</button>
									</div>
									<!-- Attendances -->
									<div class="table-responsive border-top">
										<table id="ei-indiv-attendance-table" class="table datatable-selection-single" style="width:100%">
											<thead>
												<tr>
													<th>Date</th>
													<th>Time In</th>
													<th>Time Out</th>
													<th>Total Hours</th>
													<th>Status</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>	
							</div>
						</div>
					</div>
				<!--</div>-->
			</div>
		</div>
	</div>
</div>
<!-- View Information Performance Details -->
<div id="modal-emp-performance" class="modal fade" tabindex="-1" data-bs-backdrop="static"></div>
<!-- View Request Update Information Details -->
<div id="modal-employee-request-info" class="modal fade" tabindex="-1" data-bs-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">View request information to update!</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">New information to update request</h5>
								</div>
								<ul class="list-group list-group-flush border-top">
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Name:</span>
										<div class="ms-auto" id="eriu-fullname"></div>
									</li>
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Date of birth:</span>
										<div class="ms-auto" id="eriu-dob"></div>
									</li>
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Gender:</span>
										<div class="ms-auto" id="eriu-gender"></div>
									</li>
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Email:</span>
										<div class="ms-auto" id="eriu-email"></div>
									</li>
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Contact Number:</span>
										<div class="ms-auto" id="eriu-contact-number"></div>
									</li>
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Address:</span>
										<div class="ms-auto" id="eriu-address"></div>
									</li>
									<li class="list-group-item d-flex">
										<span class="fw-semibold">Civil Status:</span>
										<div class="ms-auto" id="eriu-civil-status"></div>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-5">
    						<div class="card">
        						<div class="card-header">
            						<div class="card-title">Actions</div>
            						<form id="actions-approve-reject-emp-request">
                						<input type="hidden" id="idtoaction" name="id_seq_emp">
                						<button type="button" class="btn btn-danger" id="submitRejected">Reject</button>
            						</form>
            						<form id="actions-approve-emp-request" method="POST" action="php/employee_request_information_approved.php">
            							<input type="hidden" id="idtoaction2" name="idmoto">
            							<button type="submit" class="btn btn-success">Approve</button>
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
<!-- View Offboard Request Detail -->
<div id="offboard_detail" class="modal fade" tabindex="-1" data-bs-backdrop="static">
	<div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Offboarding Request Detail</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body" style="max-height: 100vh; overflow-y: auto;">
				<div class="row">
					<div class="col-lg-4">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<ul class="list-group list-group-flush border-top">
										<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Name: </span>
                                    		<div class="ms-auto" id="offboard-name"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Department: </span>
                                    		<div class="ms-auto" id="offboard-department"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Position: </span>
                                    		<div class="ms-auto" id="offboard-position"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Work Status: </span>
                                    		<div class="ms-auto" id="offboard-workstatus"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Work Setup: </span>
                                    		<div class="ms-auto" id="offboard-worksetup"></div>
                                		</li>
									</ul>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="card">
									<ul class="list-group list-group-flush border-top">
										<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Request Type: </span>
                                    		<div class="ms-auto" id="offboard-requesttype"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Date: </span>
                                    		<div class="ms-auto" id="offboard-date"></div>
                                		</li>
									</ul>
									<div class="modal-body">
										<div class="mb-3">
											<span class="fw-semibold">Description: </span>
											<div class="" id="offboard-description"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12" id="offboard-status-action">
								
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="card" id="offboard-file-letter-or-retirement" style="max-height: 500px; overflow-y: auto;">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- View Full Information Details Onboardee -->
<div id="onboardee-full-information-details" class="modal fade" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-full modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Onboardee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="max-height: 100vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-lg-4" style="max-height:500px; overflow-y:auto;"> <!-- Fixed Position! -->
                    	<div class="row">
                    		<div class="col-lg-12">
                    			<div class="card">
                            		<ul class="list-group list-group-flush border-top">
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Name: </span>
                                    		<div class="ms-auto" id="onboard-name"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Orient Date: </span>
                                    		<div class="ms-auto" id="onboard-orientdate"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Onboard Date: </span>
                                    		<div class="ms-auto" id="onboard-date"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Remarks: </span>
                                    		<div class="ms-auto" id="onboard-remarks"></div>
                                		</li>
                            		</ul>
                        		</div>
                    		</div>
                    		<div class="col-lg-12">
                    			<div class="card">
                    				<div class="card-body">
                    					<button type="button" id="onboard-req-viewer-button1" class="btn btn-primary" style="margin:10px;">Medical</button>
                     					<button type="button" id="onboard-req-viewer-button2" class="btn btn-primary" style="margin:10px;">NBI</button>
                     					<button type="button" id="onboard-req-viewer-button3" class="btn btn-primary" style="margin:10px;">PhilHealth</button>
                     					<button type="button" id="onboard-req-viewer-button4" class="btn btn-primary" style="margin:10px;">SSS</button>
                     					<button type="button" id="onboard-req-viewer-button5" class="btn btn-primary" style="margin:10px;">Brgy. Clearance</button>
                     					<button type="button" id="onboard-req-viewer-button6" class="btn btn-primary" style="margin:10px;">TIN</button>
                     					<button type="button" id="onboard-req-viewer-button7" class="btn btn-primary" style="margin:10px;">Picture</button>
                    				</div>
                     			</div>
                    		</div>
                    		<div class="col-lg-12">
                    			<div class="card" id="action-buttons-onboardee" style="width:100%">
                            		
                        		</div>
                    		</div>
                    	</div>
                    </div>
                    <div class="col-lg-8"> <!-- Only Scrollable -->
                    	<div class="card" style="max-height:500px; overflow-y:auto;">
                    		<!-- Basis Details -->
                    		<div id="req1pane1"></div>
                            <div id="req1pane2" style="display:none;"></div>
                            <div id="req1pane3" style="display:none;"></div>
                            <div id="req1pane4" style="display:none;"></div>
                            <div id="req1pane5" style="display:none;"></div>
                            <div id="req1pane6" style="display:none;"></div>
                            <div id="req1pane7" style="display:none;"></div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- View Applicant Details (Modify Status Approved, Failed, Qualified) -->
<div id="applicant-details" class="modal fade" tabindex="-1" data-bs-backdrop="static">
	<div class="modal-dialog modal-full modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Applicant Information</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body" style="max-height: 100vh; overflow-y: auto;">
				<div class="row">
					<div class="col-lg-4" style="max-height:550px;overflow-y: auto;">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<ul class="list-group list-group-flush border-top">
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Name: </span>
                                    		<div class="ms-auto" id="applicant-name"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Gender: </span>
                                    		<div class="ms-auto" id="applicant-gender"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Birth Date: </span>
                                    		<div class="ms-auto" id="applicant-dob"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Age: </span>
                                    		<div class="ms-auto" id="applicant-age"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Civil Status: </span>
                                    		<div class="ms-auto" id="applicant-civil-status"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Email: </span>
                                    		<div class="ms-auto" id="applicant-email"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Address: </span><br>
                                    		<div id="applicant-address" style="text-align: right;margin-left:80px;"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Contact No: </span>
                                    		<div class="ms-auto" id="applicant-contact"></div>
                                		</li>
                            		</ul>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="card">
									<ul class="list-group list-group-flush border-top">
										<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Job Category: </span>
                                    		<div class="ms-auto" id="applicant-category"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Applying Position: </span>
                                    		<div class="ms-auto" id="applicant-position"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Registration Date: </span>
                                    		<div class="ms-auto" id="applicant-regdate"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Company: </span>
                                    		<div class="ms-auto" id="applicant-company"></div>
                                		</li>
									</ul>
								</div>
							</div>
							<div class="col-lg-12" id="applicant-view-actions-form">
								
							</div>
						</div>
					</div>
					<div class="col-lg-8" style="max-height:550px;overflow-y: auto;">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Applicant Image</h5>
								<div id="applicant-images">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- View Information Details -->
<div id="leave-info" class="modal fade" tabindex="-1" data-bs-backdrop="static">
	<div class="modal-dialog modal-full modal-dialog-scrollable modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Leave Information</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body" style="max-height: 100vh; overflow-y: auto;">
				<div class="row">
					<div class="col-lg-4" style="max-height: 550px; overflow-y: auto;">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<ul class="list-group list-group-flush border-top">
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Name: </span>
											<div class="ms-auto" id="leaver-name"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Leave:</span>
											<div class="ms-auto" id="leave-type"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">To Date:</span>
											<div class="ms-auto" id="leave-todate"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">From Date:</span>
											<div class="ms-auto" id="leave-fromdate"></div>
										</li>
										<li class="list-group-item d-flex">
											<span class="fw-semibold">Date Request:</span>
											<div class="ms-auto" id="leave-reqdatete"></div>
										</li>
										<div class="mb-3">
											<div class="mb-3" style="margin-left:20px;margin-top:15px">
												<span class="fw-semibold">Reason:</span>
												<div class="" id="leave-description"></div>
											</div>
										</div>
									</ul>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="card" id="status-decision">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="card" style="max-height: 550px; overflow-y: auto;" id="img-basis-leave-detail">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- View Information Details -->
<div id="modal-emp-remote-request" class="modal fade" tabindex="-1" data-bs-backdrop="static">
	<div class="modal-dialog modal-full modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Remote Request Detail</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body" style="max-height: 100vh; overflow-y: auto;">
				<div class="row">
					<div class="col-lg-5" style="max-height:550px;overflow-y: auto;">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<ul class="list-group list-group-flush border-top">
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Name: </span>
                                    		<div class="ms-auto" id="remote-name"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Request Date: </span>
                                    		<div class="ms-auto" id="remote-reqdate"></div>
                                		</li>
                                		<li class="list-group-item d-flex">
                                    		<span class="fw-semibold">Total Score: </span>
                                    		<div class="ms-auto" id="remote-totalscore"></div>
                                		</li>
                                		<li class="list-group-item d-flex" id="remote-reason">
                                    		<!--<span class="fw-semibold">Reason: </span>
                                    		<div class="ms-auto" id="remote-reason" style="text-align: right;margin-left:80px;"></div>-->
                                		</li>
                                	</ul>
								</div>
							</div>
							<div class="col-lg-12" id="remote-decision-actions">

							</div>
						</div>
					</div>
					<div class="col-lg-7" style="max-height:550px;overflow-y: auto;">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="mb-3">
                                    		<label class="fw-bold h6">Criteria</label><br>
                                    		<label class="fw-bold">1 - Below Expectation</label><br>
                                    		<label class="fw-bold">2 - Meets Expectation</label><br>
                                    		<label class="fw-bold">3 - Satisfactory</label><br>
                                    		<label class="fw-bold">4 - Exceeds Expectation</label><br>
                                    		<label class="fw-bold">5 - Outstanding</label>
                                		</div>
                                		<!-- Jobrole Suitability -->
                                		<div class="row mb-3">
                                			<label for="jobrole_suitability" class="col-md-5 form-label fw-bold me-1">Jobrole Suitability</label>
                                			<div class="col-md-6">
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input jobrole_suitability"
                                            			type="radio"
                                            			id="jobrole_suitability"
                                            			name="jobrole_suitability"
                                            			value="1"
                                            			disabled>
                                        			<label class="form-check-label" for="jobrole_suitability">1</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input jobrole_suitability"
                                            			type="radio"
                                            			id="jobrole_suitability"
                                            			name="jobrole_suitability"
                                            			value="2"
                                            			disabled>
                                        			<label class="form-check-label" for="jobrole_suitability">2</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input jobrole_suitability"
                                            			type="radio"
                                            			id="jobrole_suitability"
                                            			name="jobrole_suitability"
                                            			value="3"
                                            			disabled>
                                        			<label class="form-check-label" for="jobrole_suitability">3</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input jobrole_suitability"
                                            			type="radio"
                                            			id="jobrole_suitability"
                                            			name="jobrole_suitability"
                                            			value="4"
                                            			disabled>
                                        			<label class="form-check-label" for="jobrole_suitability">4</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input jobrole_suitability"
                                            			type="radio"
                                            			id="jobrole_suitability"
                                            			name="jobrole_suitability"
                                            			value="5"
                                            			disabled>
                                        			<label class="form-check-label" for="jobrole_suitability">5</label>
                                    			</div>
                                			</div>
                           				</div>
                           				<!-- Performance Accountability -->
                           				<div class="row mb-3">
                                			<label for="jobrole_suitability" class="col-md-5 form-label fw-bold me-1">Performance Accountability</label>
                                			<div class="col-md-6">
                                    			<div class="form-check form-check-inline ">
                                        			<input class="form-check-input performance_accountability"
                                            			type="radio"
                                            			id="performance_accountability"
                                            			name="performance_accountability"
                                            			value="1"
                                            			disabled>
                                        			<label class="form-check-label" for="performance_accountability">1</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input performance_accountability"
                                            			type="radio"
                                            			id="performance_accountability"
                                            			name="performance_accountability"
                                            			value="2"
                                            			disabled>
                                        			<label class="form-check-label" for="performance_accountability">2</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input performance_accountability"
                                            			type="radio"
                                            			id="performance_accountability"
                                            			name="performance_accountability"
                                            			value="3"
                                            			disabled>
                                        			<label class="form-check-label" for="performance_accountability">3</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input performance_accountability"
                                            			type="radio"
                                            			id="performance_accountability"
                                            			name="performance_accountability"
                                            			value="4"
                                            			disabled>
                                        			<label class="form-check-label" for="performance_accountability">4</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input performance_accountability"
                                            			type="radio"
                                            			id="performance_accountability"
                                            			name="performance_accountability"
                                            			value="5"
                                            			disabled>
                                        			<label class="form-check-label" for="performance_accountability">5</label>
                                    			</div>
                                			</div>
                            			</div>
                            			<!-- Technological Readiness -->
                            			<div class="row mb-3">
                                			<label for="jobrole_suitability" class="col-md-5 form-label fw-bold me-1">Technological Readiness</label>
                                			<div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input technological_readiness"
                                            type="radio"
                                            id="technological_readiness"
                                            name="technological_readiness"
                                            value="1"
                                            disabled>
                                        <label class="form-check-label" for="technological_readiness">1</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input technological_readiness"
                                            type="radio"
                                            id="technological_readiness"
                                            name="technological_readiness"
                                            value="2"
                                            disabled>
                                        <label class="form-check-label" for="technological_readiness">2</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input technological_readiness"
                                            type="radio"
                                            id="technological_readiness"
                                            name="technological_readiness"
                                            value="3"
                                            disabled>
                                        <label class="form-check-label" for="technological_readiness">3</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input technological_readiness"
                                            type="radio"
                                            id="technological_readiness"
                                            name="technological_readiness"
                                            value="4"
                                            disabled>
                                        <label class="form-check-label" for="technological_readiness">4</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input technological_readiness"
                                            type="radio"
                                            id="technological_readiness"
                                            name="technological_readiness"
                                            value="5"
                                            disabled>
                                        <label class="form-check-label" for="technological_readiness">5</label>
                                    </div>
                                			</div>
                            			</div>
                            			<!-- Work Environment -->
                            			<div class="row mb-3">
                                			<label for="jobrole_suitability" class="col-md-5 form-label fw-bold me-1">Work Environment</label>
                                			<div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input work_environment"
                                            type="radio"
                                            id="work_environment"
                                            name="work_environment"
                                            value="1"
                                            disabled>
                                        <label class="form-check-label" for="work_environment">1</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input work_environment"
                                            type="radio"
                                            id="work_environment"
                                            name="work_environment"
                                            value="2"
                                            disabled>
                                        <label class="form-check-label" for="work_environment">2</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input work_environment"
                                            type="radio"
                                            id="work_environment"
                                            name="work_environment"
                                            value="3"
                                            disabled>
                                        <label class="form-check-label" for="work_environment">3</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input work_environment"
                                            type="radio"
                                            id="work_environment"
                                            name="work_environment"
                                            value="4"
                                            disabled>
                                        <label class="form-check-label" for="work_environment">4</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input work_environment"
                                            type="radio"
                                            id="work_environment"
                                            name="work_environment"
                                            value="5"
                                            disabled>
                                        <label class="form-check-label" for="work_environment">5</label>
                                    </div>
                                			</div>
                            			</div>
                            			<!-- Communication Skills -->
                            			<div class="row mb-3">
                                			<label for="jobrole_suitability" class="col-md-5 form-label fw-bold me-1">Communication Skills</label>
                                			<div class="col-md-6">
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input communication_skills"
                                            			type="radio"
                                            			id="communication_skills"
                                            			name="communication_skills"
                                            			value="1"
                                            			disabled>
                                        			<label class="form-check-label" for="communication_skills">1</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input communication_skills"
                                            			type="radio"
                                            			id="communication_skills"
                                            			name="communication_skills"
                                            			value="2"
                                            			disabled>
                                        			<label class="form-check-label" for="communication_skills">2</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input communication_skills"
                                            			type="radio"
                                            			id="communication_skills"
                                            			name="communication_skills"
                                            			value="3"
                                            			disabled>
                                        			<label class="form-check-label" for="communication_skills">3</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input communication_skills"
                                            			type="radio"
                                            			id="communication_skills"
                                            			name="communication_skills"
                                            			value="4"
                                            			disabled>
                                        			<label class="form-check-label" for="communication_skills">4</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input communication_skills"
                                            			type="radio"
                                            			id="communication_skills"
                                            			name="communication_skills"
                                            			value="5"
                                            			disabled>
                                        			<label class="form-check-label" for="communication_skills">5</label>
                                    			</div>
                                			</div>
                            			</div>
                            			<!-- Flexibility Adaptability -->
                            			<div class="row mb-3">
                                			<label for="jobrole_suitability" class="col-md-5 form-label fw-bold me-1">Flexibility Adaptability</label>
                                			<div class="col-md-6">
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input flexibility_adaptability"
                                            			type="radio"
                                            			id="flexibility_adaptability"
                                            			name="flexibility_adaptability"
                                            			value="1"
                                            			disabled>
                                        			<label class="form-check-label" for="flexibility_adaptability">1</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input flexibility_adaptability"
                                            			type="radio"
                                            			id="flexibility_adaptability"
                                            			name="flexibility_adaptability"
                                            			value="2"
                                            			disabled>
                                        			<label class="form-check-label" for="flexibility_adaptability">2</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input flexibility_adaptability"
                                            			type="radio"
                                            			id="flexibility_adaptability"
                                            			name="flexibility_adaptability"
                                            			value="3"
                                            			disabled>
                                        			<label class="form-check-label" for="flexibility_adaptability">3</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input flexibility_adaptability"
                                            			type="radio"
                                            			id="flexibility_adaptability"
                                            			name="flexibility_adaptability"
                                            			value="4"
                                            			disabled>
                                        			<label class="form-check-label" for="flexibility_adaptability">4</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input flexibility_adaptability"
                                            			type="radio"
                                            			id="flexibility_adaptability"
                                            			name="flexibility_adaptability"
                                            			value="5"
                                            			disabled>
                                        			<label class="form-check-label" for="flexibility_adaptability">5</label>
                                    			</div>
                                			</div>
                            			</div>
                            			<!-- Health Wellbeing -->
                            			<div class="row mb-3">
                                			<label for="jobrole_suitability" class="col-md-5 form-label fw-bold me-1">Health Wellbeing</label>
                                			<div class="col-md-6">
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input health_wellbeing"
                                            			type="radio"
                                            			id="health_wellbeing"
                                            			name="health_wellbeing"
                                            			value="1"
                                            			disabled>
                                        			<label class="form-check-label" for="health_wellbeing">1</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input health_wellbeing"
                                            			type="radio"
                                            			id="health_wellbeing"
                                            			name="health_wellbeing"
                                            			value="2"
                                            			disabled>
                                        			<label class="form-check-label" for="health_wellbeing">2</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input health_wellbeing"
                                            			type="radio"
                                            			id="health_wellbeing"
                                            			name="health_wellbeing"
                                            			value="3"
                                            			disabled>
                                        			<label class="form-check-label" for="health_wellbeing">3</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input health_wellbeing"
                                            			type="radio"
                                            			id="health_wellbeing"
                                            			name="health_wellbeing"
                                            			value="4"
                                            			disabled>
                                        			<label class="form-check-label" for="health_wellbeing">4</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input health_wellbeing"
                                            			type="radio"
                                            			id="health_wellbeing"
                                            			name="health_wellbeing"
                                            			value="5"
                                            			disabled>
                                        			<label class="form-check-label" for="health_wellbeing">5</label>
                                    			</div>
                                			</div>
                            			</div>
                            			<!-- Organizational Needs -->
                            			<div class="row mb-3">
                                			<label for="jobrole_suitability" class="col-md-5 form-label fw-bold me-1">Organizational Needs</label>
                                			<div class="col-md-6">
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input organizational_needs"
                                            			type="radio"
                                            			id="organizational_needs"
                                            			name="organizational_needs"
                                            			value="1"
                                            			disabled>
                                        			<label class="form-check-label" for="organizational_needs">1</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input organizational_needs"
                                            			type="radio"
                                            			id="organizational_needs"
                                            			name="organizational_needs"
                                            			value="2"
                                            			disabled>
                                        			<label class="form-check-label" for="organizational_needs">2</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input organizational_needs"
                                            			type="radio"
                                            			id="organizational_needs"
                                            			name="organizational_needs"
                                            			value="3"
                                            			disabled>
                                        			<label class="form-check-label" for="organizational_needs">3</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input organizational_needs"
                                            			type="radio"
                                            			id="organizational_needs"
                                            			name="organizational_needs"
                                            			value="4"
                                            			disabled>
                                        			<label class="form-check-label" for="organizational_needs">4</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input organizational_needs"
                                            			type="radio"
                                            			id="organizational_needs"
                                            			name="organizational_needs"
                                            			value="5"
                                            			disabled>
                                        			<label class="form-check-label" for="organizational_needs">5</label>
                                    			</div>
                                			</div>
                            			</div>
                            			<!-- Legal Compliance -->
                            			<div class="row mb-3">
                                			<label for="jobrole_suitability" class="col-md-5 form-label fw-bold me-1">Legal Compliance</label>
                                			<div class="col-md-6">
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input legal_compliance"
                                            			type="radio"
                                            			id="legal_compliance"
                                            			name="legal_compliance"
                                            			value="1"
                                            			disabled>
                                        			<label class="form-check-label" for="legal_compliance">1</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input legal_compliance"
                                            			type="radio"
                                            			id="legal_compliance"
                                            			name="legal_compliance"
                                            			value="2"
                                            			disabled>
                                        			<label class="form-check-label" for="legal_compliance">2</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input legal_compliance"
                                            			type="radio"
                                            			id="legal_compliance"
                                            			name="legal_compliance"
                                            			value="3"
                                            			disabled>
                                        			<label class="form-check-label" for="legal_compliance">3</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input legal_compliance"
                                            			type="radio"
                                            			id="legal_compliance"
                                            			name="legal_compliance"
                                            			value="4"
                                            			disabled>
                                        			<label class="form-check-label" for="legal_compliance">4</label>
                                    			</div>
                                    			<div class="form-check form-check-inline">
                                        			<input class="form-check-input legal_compliance"
                                            			type="radio"
                                            			id="legal_compliance"
                                            			name="legal_compliance"
                                            			value="5"
                                            			disabled>
                                        			<label class="form-check-label" for="legal_compliance">5</label>
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
	</div>
</div>