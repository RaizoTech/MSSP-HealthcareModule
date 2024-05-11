<!-- Dashboard -->
<div id="hr_p1">
	<div class="row">
		<div class="col-lg-4">
			<!-- Members online -->
			<div class="card bg-teal text-white">
				<div class="card-body">
					<div class="d-flex">
						<h3 id="total-employees" class="mb-0"></h3>
						<div class="dropdown d-inline-flex ms-auto">
							<a href="#" class="text-white d-inline-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
							</a>
						</div>
					</div>
					<div>
						Employee Total
						<div class="fs-sm opacity-75"></div>
					</div>
				</div>
				<div class="rounded-bottom overflow-hidden mx-3" id="members-online"></div>
			</div>
			<!-- /members online -->
		</div>
		<div class="col-lg-4">
			<!-- Current server load -->
			<div class="card bg-primary text-white">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h3 id="total-remote-req" class="mb-0"></h3>
						<div class="dropdown d-inline-flex ms-auto">
							<a href="#" class="text-white d-inline-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
							</a>
						</div>
					</div>
					<div>
						Remote Request Approval
					</div>
				</div>
				<div class="rounded-bottom overflow-hidden" id="server-load"></div>
			</div>
			<!-- /current server load -->
		</div>
		<div class="col-lg-4">
			<!-- Current server load -->
			<div class="card bg-pink text-white">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h3 id="total-leave-req" class="mb-0"></h3>
						<div class="dropdown d-inline-flex ms-auto">
							<a href="#" class="text-white d-inline-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
							</a>
						</div>
					</div>
					<div>
						Leave Request Approval
					</div>
				</div>
				<div class="rounded-bottom overflow-hidden" id="server-load"></div>
			</div>
			<!-- /current server load -->
		</div>
		<div class="col-lg-4">
			<!-- Today's revenue -->
			<div class="card bg-primary text-white">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h3 id="onboarding_total" class="mb-0"></h3>
						<div class="dropdown d-inline-flex ms-auto">
							<a href="#" class="text-white d-inline-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
							</a>
						</div>
					</div>
					<div>
						Onboarding Approval
					</div>
				</div>
				<div class="rounded-bottom overflow-hidden" id="today-revenue"></div>
			</div>
			<!-- /today's revenue -->
		</div>
	</div>
</div>
<!-- /Dashboard -->
<!-- Employees -->
<div id="hr_p2">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Employees</h5>
		</div>
		<table id="employee-table1" class="table datatable-selection-single" style="width:100%">
			<thead>
				<tr>
					<th>Name</th>
					<th>Department</th>
					<th>Position</th>
					<th>Status</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- /Employees -->
<!-- Employees Performance -->
<!--<div id="hr_p3">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Employee Performances</h5>
		</div>
		<div class="table-responsive">
			<table id="employee-performances" class="table datatable-selection-single" style="width:100%">
				<thead>
					<tr>
						<th>Name</th>
						<th><center>Average Feedback Rating</center></th>
						<th><center>Average Present</center></th>
						<th><center>Average Absent</center></th>
						<th><center>Action</center></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>-->
<!-- /Employees Performance -->
<!-- Onboardings -->
<div id="hr_p4">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Onboardings</h5>
		</div>
		<table id="onboarding-list-table" class="table datatable-selection-single" style="width:100%">
			<thead>
				<tr>
					<th>Name</th>
                    <th>Position</th>
                    <th>Company</th>
                    <th>Onboard Date</th>
                    <th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- /Onboardings -->
<!-- Offboardings -->
<div id="hr_p6">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Offboarding List</h5>
		</div>
		<table id="offboarding-list-approval" class="table datatable-selection-single" style="width:100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
                    <th>Position</th>
                    <th>Leave Type</th>
                    <th>Request Date</th>
                    <th><center>Action</center></th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!-- /Offboardings -->
<!-- Leave Request -->
<div id="hr_p7">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Leave Request</h5>
		</div>
		<table id="leave-request-table" class="table datatable-selection-single" style="width:100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th><center>Type</center></th>
					<th>To Date</th>
					<th>From Date</th>
					<th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- /Leave Request -->
<!-- Remote Request -->
<div id="hr_p8">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Remote Request</h5>
		</div>
		<table id="remote-request-table" class="table datatable-selection-single" style="width:100%">
			<thead>
				<tr>
					<th>Employee ID</th>
					<th>Name</th>
                    <th>Score</th>
                    <th>Date</th>
                    <th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- /Remote Request -->
<!-- Job Applicants -->
<div id="hr_p9">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Job Applicants</h5>
		</div>
		<table id="applicants-list-table" class="table datatable-selection-single" style="width:100%">
			<thead>
				<tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Applying Position</th>
                    <th>Category</th>
                    <th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- /Job Applicants -->
<!-- Health Articles -->
<!-- /Health Articles -->
<!-- Extra Pages -->
<!--<div id="extra-panel1">
	<div class="card">
		<div class="card-header"><h5 class="mb-0">Schedules</h5></div>
		<div class="table-responsive">
			<table id="schedules-set-table" class="table datatable-selection-single">
				<thead>
					<tr>
						<th>Rotate Schedule</th>
						<th><center>Shift</center></th>
						<th><center>Time In & Out</center></th>
						<th>Total Hours</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>-->
<!--<div id="extra-panel2">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Attendances</h5>
		</div>
		<div class="card-body">
			<span class="fw-semibold">All employees attendance and time durations</span>
		</div>
		<div class="table-responsive">
			<table id="employee-attendances" class="table datatable-selection-single" style="width:100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Date</th>
						<th>Time(IN)</th>
						<th>Time(OUT)</th>
						<th>Status</th>
						<th>Total Hours</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>-->
<!--<div id="employee-request-panel">
	<div class="mb-3">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Request Update Information!</h5>
			</div>
			<div class="card-body">
				
			</div>
		</div>
	</div>
</div>-->