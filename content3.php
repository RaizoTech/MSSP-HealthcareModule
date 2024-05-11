<!-- Dashboard -->
<div id="health-ad-panel1">
	<div class="row">
		<div class="col-lg-4">
			<!-- Members online -->
			<div class="card bg-teal text-white">
				<div class="card-body">
					<div class="d-flex">
						<h3 id="total-employees" class="mb-0"></h3>
						<div class="dropdown d-inline-flex ms-auto">
							<a href="#" class="text-white d-inline-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
								<i class="ph-gear"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a href="#" onclick="EHR_list()" class="dropdown-item">
									<script type="text/javascript">
										function EHR_list(){
											$('#health-ad-panel1').css('display','none');
											$('#health-ad-panel2').css('display','block');
											$('#health-ad-panel3').css('display','none');
											$('#health-ad-panel4').css('display','none');
											$('#health-ad-panel5').css('display','none');
											$('#health-ad-panel6').css('display','none');
											$('#health-ad-panel7').css('display','none');
											$('#health-ad-panel8').css('display','none');
										}
									</script>
									<i class="ph-list-dashes me-2"></i>
									Detailed log
								</a>
							</div>
						</div>
					</div>
					<div>
						Employee Health Records
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
						Articles Deploy
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
								<i class="ph-gear"></i>
								View Detailed
							</a>
						</div>
					</div>
					<div>
						Check Up Appointments
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
						Counselling Appointments
					</div>
				</div>
				<div class="rounded-bottom overflow-hidden" id="today-revenue"></div>
			</div>
			<!-- /today's revenue -->
		</div>
	</div>
</div>
<!-- /Dashboard -->
<!-- Employee Health Records -->
<div id="health-ad-panel2">
	<!-- content -->
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Employees No. Appointments</h5>
		</div>
		<table id="health-records-table" class="table datatable-selection-single" style="width:100%">
			<thead>
				<tr>
					<th>Name</th>
                    <th><center>No. Check Up Appointments</center></th>
                    <th><center>No. Counselling Appointments</center></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- /Employee Health Records -->
<!-- Check up appointments -->
<div id="health-ad-panel3">
	<!-- content -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center">
        	<h5 class="mb-0">Checkup Appointments</h5>
        	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manual-checkup">
            	<i class="ph ph-magnifying-glass-plus"></i>
            	Manually Checkup
        	</button>
    	</div>
		<table id="checkup-appointments-table" class="table datatable-selection-single" style="width:100%">
			<thead>
				<tr>
					<th>Name</th>
                    <th><center>Checkup Date</center></th>
                    <th><center>Checkup Time</center></th>
                    <th><center>Checkup Type</center></th>
                    <th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- /Check up appointments -->
<!-- Counselling Appointments -->
<div id="health-ad-panel4">
	<!-- content -->
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Counselling Appointments</h5>
		</div>
		<div class="card-body">
			<span class="fw-semibold">Health and wellness programs often include counseling appointments as part of their comprehensive approach to supporting employees' mental and emotional well-being. Counseling appointments provide individuals with a dedicated space to address personal concerns, manage stress, and improve overall mental health. Here's how counseling appointments may be integrated into health and wellness programs.</span>
		</div>
		<table id="counselling-appointments-table" class="table datatable-selection-single" style="width:100%">
			<thead>
				<tr>
					<th>Name</th>
                    <th>Counselling Service</th>
                    <th>Date</th>
                    <th>Time</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- /Counselling Appointments -->
<!-- Counselling Services -->
<div id="health-ad-panel5">
	<!-- content -->
	<div class="page-header page-header-light shadow">
		<div class="page-header-content d-lg-flex">
			<div class="d-flex">
				<h4 class="page-title mb-0">
					Counselling - <span class="fw-normal">Services</span>
				</h4>

				<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
					<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
				</a>
			</div>
			<div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
    			<div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
        			<div class="dropdown w-100 w-sm-auto">
            			<a href="#" class="d-flex align-items-center text-body lh-1 dropdown-toggle py-sm-2" data-bs-toggle="dropdown" data-bs-display="static" id="dropdownMenuLink">
                			<img src="assets1/images/brands/images.jpg" class="w-32px h-32px me-2" alt="" id="companyImage">
                			<div class="me-auto me-lg-1">
                    			<div class="fs-sm text-muted mb-1">Services</div>
                    			<div class="fw-semibold services-name" id="companyName">No items yet</div>
                			</div>
            			</a>
            			<div class="dropdown-menu dropdown-menu-lg-end w-100 w-lg-auto wmin-300 wmin-sm-350 pt-0" id="counselling-services-list">
            			</div>
        			</div>
        			<div class="d-inline-flex mt-3 mt-sm-0">
            			<a href="#" class="btn btn-outline-primary btn-icon w-32px h-32px rounded-pill ms-3" data-bs-toggle="modal" data-bs-target="#add-counselling-services">
                			<i class="ph-plus"></i>
           		 		</a>
        			</div>
    			</div>
			</div>
		</div>
	</div>
	<!-- -->
	<div id="employee-appointment-perservices" style="display: none;">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-md-center">
					<div class="col-md-6">
						<div class="mb-3">
							<center>
								<img src="images_counselling_services/Blue_and_Green_Modern_Moonstone_Psychotherapy_and_Counseling_Logo.png" class="rounded-pill" style="width:30%" id="counselling-service-logo-presentation">
							</center>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3" style="text-align: justify;margin-right:3.3rem;" id="fetch-content">
							This section usually contains details about past illnesses, surgeries, injuries, and treatments the employee has undergone. Information about any medications the employee is currently taking or has taken in the past, including dosage and frequency. Any known allergies the employee has, such as food allergies, medication allergies, or allergies to substances like pollen or latex. Records of vaccinations or immunizations the employee has received, including dates and types of vaccines.
						</div>
					</div>
				</div>
			</div>
			<table id="employee-appointment-services-table" class="table datatable-selection-single" style="width:100%">
				<thead>
					<tr>
						<th>Name</th>
                    	<th><center>Department</center></th>
                    	<th><center>Position</center></th>
                    	<th><center>Date Time</center></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /Counselling Services -->
<!-- Health & Wellness Articles -->
<div id="health-ad-panel7">
	<!-- content -->
	<div class="page-header page-header-light shadow">
		<div class="page-header-content justify-content-center d-lg-flex">
    		<div class="d-flex align-items-center">
        		<h4 class="page-title mb-0">
            		<span class="fw-normal">Health Article's</span>
        		</h4>
        		<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            		<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        		</a>
    		</div>
    		<div class="d-flex align-items-center ms-lg-3">
        		<form id="search-form-articles" method="POST" action="php_hw/search_articles.php" class="card-body d-sm-flex">
            		<div class="form-control-feedback form-control-feedback-start flex-grow-1 mb-3 mb-sm-0">
                		<input type="text" class="form-control" id="search-article" name="search_article" value="" placeholder="Search" style="width:100%;">
                		<div class="form-control-feedback-icon">
                    		<i class="ph-magnifying-glass"></i>
                		</div>
            		</div>
            		<div class="ms-sm-3">
                		<button type="submit" class="btn btn-primary w-100 w-sm-auto">Search</button>
            		</div>
        		</form>
    		</div>
    		<div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
        		<div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            		<div class="dropdown w-100 w-sm-auto">
                		<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#article-addnew-m">
                    		<i class="ph ph-list-plus"></i>
                    		Add New Article
                		</button>
            		</div>
        		</div>
    		</div>
		</div>
	</div><br>
	<!-- Search field -->
	<div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3" id="result-here">
		<!-- Result -->
	</div>
</div>
<!-- /Health & Wellness Articles -->
<!-- Health & Wellness Program -->
<div id="health-ad-panel8">
	<!-- content -->
	<div class="page-header page-header-light shadow">
		<div class="page-header-content justify-content-center d-lg-flex">
    		<div class="d-flex align-items-center">
        		<h4 class="page-title mb-0">
            		<span class="fw-normal">Health Program's</span>
        		</h4>
        		<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            		<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        		</a>
    		</div>
    		<div class="d-flex align-items-center ms-lg-3">
        		<form id="search-form-programs" method="POST" action="php_hw/search_programs.php" class="card-body d-sm-flex">
            		<div class="form-control-feedback form-control-feedback-start flex-grow-1 mb-3 mb-sm-0">
                		<input type="text" class="form-control" id="search-program" name="search_program" value="" placeholder="Search" style="width:100%;">
                		<div class="form-control-feedback-icon">
                    		<i class="ph-magnifying-glass"></i>
                		</div>
            		</div>
            		<div class="ms-sm-3">
                		<button type="submit" class="btn btn-primary w-100 w-sm-auto">Search</button>
            		</div>
        		</form>
    		</div>
    		<div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
        		<div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            		<div class="dropdown w-100 w-sm-auto">
                		<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#program-addnew-m">
                    		<i class="ph ph-list-plus"></i>
                    		Add New Health Program
                		</button>
            		</div>
        		</div>
    		</div>
		</div>
	</div><br>
	<!-- Search field -->
	<div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3" id="result-here-programs">
		<!-- Result -->
	</div>
</div>
<!-- /Health & Wellness Program -->