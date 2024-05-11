						<?php
						if($data_position['name'] === 'HR Manager'){
						?>
						<li class="nav-item">
							<a href="#" id="hr_s1" class="nav-link">
								<i class="ph-house"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-fill ph-users-four"></i>
								<span>Employees Information</span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="#" id="hr_s2" class="nav-link">Employees</a></li>
								<!--<li class="nav-item"><a href="#" id="hr-emp-req-sb" class="nav-link">Employees Request</a></li>-->
							</ul>
						</li>
						<!--<li class="nav-item">
							<a href="#" id="hr_s3" class="nav-link">
								<i class="ph-fill ph-percent"></i>
								<span>Employees Performance</span>
							</a>
						</li>-->
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-fill ph-handshake"></i>
								<span>Onboard & Applicants</span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="#" id="hr_s4" class="nav-link">Onboardings</a></li>
								<li class="nav-item"><a href="#" id="hr_s9" class="nav-link">Job Applicants</a></li>
							</ul>
						</li>
						<!--<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-fill ph-timer"></i>
								<span>Schedules & Attendance</span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="#" id="hr-s-ex1" class="nav-link">Schedules</a></li>
								<li class="nav-item"><a href="#" id="hr-s-ex2" class="nav-link">Attendances</a></li>
							</ul>
						</li>-->
						<li class="nav-item">
							<a href="#" id="hr_s6" class="nav-link">
								<i class="ph-fill ph-arrow-fat-lines-left"></i>
								<span>Offboardings</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="hr_s7" class="nav-link">
								<i class="ph-fill ph-sign-out"></i>
								<span>Leave Request</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="hr_s8" class="nav-link">
								<i class="ph-fill ph-share-network"></i>
								<span>Remote Request</span>
							</a>
						</li>
						<?php
						}
						if($data_position['name'] === 'Executive General Manager' || $data_position['name'] === 'Senior Manager'){
						?>
						<li class="nav-item">
							<a href="#" id="re-egm-s1" class="nav-link">
								<i class="ph-house"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="re-egm-s2" class="nav-link">
								<i class="ph-fill ph-users-four"></i>
								<span>Employees</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="re-egm-s3" class="nav-link">
								<i class="ph-fill ph-handshake"></i>
								<span>Onboardings</span>
							</a>
						</li>
						<!--<li class="nav-item">
							<a href="#" id="re-egm-s4" class="nav-link">
								<i class="ph-fill ph-timer"></i>
								<span>Schedules & Attendance</span>
							</a>
						</li>-->
						<li class="nav-item">
							<a href="#" id="re-egm-s5" class="nav-link">
								<i class="ph-fill ph-arrow-fat-lines-left"></i>
								<span>Offboardings</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="re-egm-s6" class="nav-link">
								<i class="ph-fill ph-article"></i>
								<span>Health Articles</span>
							</a>
						</li>
						<?php
						}
						if($data_position['name'] === 'Healthcare Administrator'){
						?>
						<!-- has1 -->
						<li class="nav-item">
							<a href="#" id="health-ad-sb1" class="nav-link">
								<i class="ph-house"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-ad-sb2" class="nav-link">
								<i class="ph ph-heart"></i>
								<span>Employees No. Appointments</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-ad-sb3" class="nav-link">
								<i class="ph ph-list-checks"></i>
								<span>Check Up Appointments</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-ad-sb4" class="nav-link">
								<i class="ph ph-app-window"></i>
								<span>Counselling Appointments</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-ad-sb5" class="nav-link">
								<i class="ph ph-cell-signal-full"></i>								
								<span>Counselling Services</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-ad-sb7" class="nav-link">
								<i class="ph ph-article"></i>
								<span>HW - Articles</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-ad-sb8" class="nav-link">
								<i class="ph ph-text-align-justify"></i>
								<span>HW - Programs</span>
							</a>
						</li>
						<?php
						}
						if($data_position['name'] === 'Healthcare Provider'){
						?>
						<!-- has1 -->
						<li class="nav-item">
							<a href="#" id="health-pr-sb1" class="nav-link">
								<i class="ph-house"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-pr-sb2" class="nav-link">
								<i class="ph ph-heart"></i>
								<span>Employee Health Records</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-pr-sb3" class="nav-link">
								<i class="ph ph-list-checks"></i>
								<span>Check Up Appointments</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-pr-sb4" class="nav-link">
								<i class="ph ph-app-window"></i>
								<span>Counselling Appointments</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-pr-sb5" class="nav-link">
								<i class="ph ph-cell-signal-full"></i>
								<span>Counselling Services</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-pr-sb6" class="nav-link">
								<i class="ph ph-article"></i>
								<span>HW - Articles</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" id="health-pr-sb7" class="nav-link">
								<i class="ph ph-text-align-justify"></i>
								<span>HW - Progs</span>
							</a>
						</li>
						<?php
						} 
						?>