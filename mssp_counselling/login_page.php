<?php

session_start();

if (isset($_SESSION['cm_id']) && isset($_SESSION['service_id'])){
	header('Location: index.php');
}
else{
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Workfolio - Counselling Services & Appointments</title>
    <!-- Global stylesheets -->
    <link rel="icon" href="../workfolio_hr_logo.png" type="image/png" />
    <link href="../assets1/fonts/inter/inter.css" rel="stylesheet" type="text/css">
    <link href="../assets1/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/ltr/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="../assets1/demo/demo_configurator.js"></script>
    <script src="../assets1/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../assets1/js/vendor/notifications/noty.min.js"></script>
    <script src="../assets1/demo/pages/extra_noty.js"></script>
    <script src="../assets1/js/jquery/jquery.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <!-- /theme JS files -->
    <script type="text/javascript">
        $(document).ready(function() {
        	//$('html').attr('data-color-theme', 'dark');
            $('.login-form').submit(function(event) {
                event.preventDefault();
                
                var usernameOrEmail = $('input[name="username_or_email"]').val();
                var password = $('input[name="password"]').val();
                
                $.ajax({
                    url: 'php/login_request.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username_or_email: usernameOrEmail,
                        password: password
                    },
                    success: function(response) {
                        if (response.result.success) {
                            new Noty({
                    			text: response.result.message,
                    			type: 'success'
                			}).show();
                            window.location.href = 'index.php'; // Redirect to index.php
                        } else {
                            new Noty({
                    			text: response.result.message,
                    			type: 'error'
                			}).show();
                        }
                    },
                    error: function(xhr, status, error) {
                        new Noty({
                    		text: 'An error occurred. Please try again later.',
                    		type: 'error'
                		}).show();
                        console.log("Error: " + error);
                    }
                });
            });        
        });
    </script>
</head>
<body>
	<!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Inner content -->
            <div class="content-inner">
                <!-- Content area -->
                <div class="content d-flex justify-content-center align-items-center">
                    <!-- Login card -->
                    <form class="login-form" method="POST" action="php/login_request.php">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                                        <img src="../workfolio_hr_logo.png" class="img-fluid" alt="" style="width:45%">
                                    </div>
                                    <span class="d-block text-muted">Counselling Service</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Username/Email</label>
                                    <div class="form-control-feedback form-control-feedback-start">
                                        <input type="text" name="username_or_email" class="form-control" placeholder="Enter your username or email">
                                        <div class="form-control-feedback-icon">
                                            <i class="ph-user-circle text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="form-control-feedback form-control-feedback-start">
                                        <input type="password" name="password" class="form-control" placeholder="•••••••••••">
                                        <div class="form-control-feedback-icon">
                                            <i class="ph-lock text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" checked>
                                        <span class="form-check-label">Remember</span>
                                    </label>
                                    <a href="login_password_recover.html" class="ms-auto">Forgot password?</a>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" id="sweet_success1" class="btn btn-primary w-100">Sign in</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /login card -->
                </div>
                <!-- /content area -->
            </div>
            <!-- /inner content -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</body>
</html>
<?php
}
?>