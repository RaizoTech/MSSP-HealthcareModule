<?php

require_once 'config.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Initialize PHPMailer
$mail = new PHPMailer;

// Initialize configuration
$config = new config();
$connection = $config->getConnection();
$addservice = ['success' => false, 'message' => ''];
$filepath = '../images_counselling_services/';

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate unique IDs for new service and mentor
    $new_service_id = generateRandomString(6);
    $mentor_id = 'MTR-' . generateRandomString(5);

    // Extract form data
    $service_name = $_POST['new_service_name'];
    $service_description = $_POST['service_description'];
    $service_address = $_POST['new_address'];
    $service_contact = $_POST['new_service_contact'];
    $mentor_firstname = $_POST['first_name_mentor'];
    $mentor_lastname = $_POST['last_name_mentor'];
    $email_address = $_POST['email_mentor'];
    $username = $_POST['username_mentor'];
    $password = $_POST['password_mentor'];

    // Hash password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Check if files are uploaded and move them to the specified directory
    if (isset($_FILES['service_logo']) && $_FILES['service_logo']['error'] != UPLOAD_ERR_NO_FILE && isset($_FILES['img_mentor']) && $_FILES['img_mentor']['error'] != UPLOAD_ERR_NO_FILE) {
        $targetFile1 = $filepath . basename($_FILES["service_logo"]["name"]);
        $targetFile2 = $filepath . basename($_FILES["img_mentor"]["name"]);

        if (move_uploaded_file($_FILES["service_logo"]["tmp_name"], $targetFile1) && move_uploaded_file($_FILES["img_mentor"]["tmp_name"], $targetFile2)) {
            $imagefilename1 = $_FILES['service_logo']['name'];
            $imagefilename2 = $_FILES['img_mentor']['name'];

            // Insert data into MySQL
            $sql1 = "INSERT INTO `work_mssp_hw`.`counselling_service`(service_id, service_logo, service_name, service_description, address, contact_no) VALUES(?, ?, ?, ?, ?, ?)";
			$sql2 = "INSERT INTO `work_mssp_hw`.`counselling_mentors`(cm_id, service_id, img_url, first_name, last_name, email_address, username, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

			$stmt1 = $connection->prepare($sql1);
			$stmt2 = $connection->prepare($sql2);

			$stmt1->bind_param("ssssss", $new_service_id, $imagefilename1, $service_name, $service_description, $service_address, $service_contact);
			$stmt2->bind_param("ssssssss", $mentor_id, $new_service_id, $imagefilename2, $mentor_firstname, $mentor_lastname, $email_address, $username, $password_hashed);
			// Execute statements
			if ($stmt1->execute() && $stmt2->execute()) {
    			try {
                	$fullname = $mentor_firstname.' '.$mentor_lastname;
                    // Setup SMTP 
            		$mail->isSMTP();
  					$mail->Host = 'smtp.gmail.com';
  					$mail->SMTPAuth = true;
  					$mail->Username = 'malto.kienth06@gmail.com';
  					//$mail->Password = 'lpprhuisweirjeii';
  					$mail->Password = 'nshdjppdmzcduzzs';
  					$mail->SMTPSecure = 'tls';
  					$mail->Port = 587;
  					// Set Email Sent to and from
  					$mail->setFrom('malto.kienth06@gmail.com', 'Workfolio Administrative Manager');
  					$mail->addAddress($email_address, $fullname);
  					// Set the email subject
  					$mail->Subject = 'Counselling Service Appointed - Your official user credential appointed to counselling service category -'.$service_name;
  					//Design
  					$mail->isHTML(true);
                    $html_body = '
  					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  					<html>
  					<head>
  						<!-- Compiled with Bootstrap Email version: 1.3.1 -->
    					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    					<meta http-equiv="x-ua-compatible" content="ie=edge">
    					<meta name="x-apple-disable-message-reformatting">
    					<meta name="viewport" content="width=device-width, initial-scale=1">
    					<meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    					<style type="text/css">
      						body,table,td{font-family:Helvetica,Arial,sans-serif !important;background:#CADCFC }.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-]){font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,.w-full>tbody>tr>td{width:100% !important}.w-24,.w-24>tbody>tr>td{width:240px !important}.w-40,.w-40>tbody>tr>td{width:160px !important}.p-lg-10:not(table),.p-lg-10:not(.btn)>tbody>tr>td,.p-lg-10.btn td a{padding:0 !important}.p-3:not(table),.p-3:not(.btn)>tbody>tr>td,.p-3.btn td a{padding:12px !important}.p-6:not(table),.p-6:not(.btn)>tbody>tr>td,.p-6.btn td a{padding:24px !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-4>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-6>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-10>tbody>tr>td{font-size:40px !important;line-height:40px !important;height:40px !important}}
    					</style>
  					</head>
  					<body class="bg-light" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
  						<table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
      						<tbody>
        						<tr>
          							<td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc">
            							<table class="container" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
              								<tbody>
                								<tr>
                  									<td align="center" style="line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;">
                    									<!--[if (gte mso 9)|(IE)]>
                      							<table align="center" role="presentation">
                        <tbody>
                          <tr>
                            <td width="600">
                    <![endif]-->
                    <table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; margin: 0 auto;">
                      <tbody>
                        <tr>
                          <td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">
                            <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                              <tbody>
                                <tr>
                                  <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40">
                                    &#160;
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                              <tbody>
                                <tr>
                                  <td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">
                                    <img class="w-24" src="https://chcs.workfoliohumanresource.com/assets/favicon-32x32.png" style="height: auto; line-height: 100%; outline: none; text-decoration: none; display: block; width: 90px; border-style: none; border-width: 0;" width="96">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                              <tbody>
                                <tr>
                                  <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40">
                                    &#160;
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="card p-6 p-lg-10 space-y-4" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0" bgcolor="#ffffff">
                              <tbody>
                                <tr>
                                  <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 40px;background: #8AB6F9;" align="left" bgcolor="#ffffff">
                                    <center>
                                     
                                    </center>
                                    
                                    <table class="s-4 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                      <tbody>
                                        <tr>
                                          <td style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;background: #8AB6F9;" align="left" width="100%" height="16">
                                            &#160;
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <p class="" style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;text-align: left;color:#fff;" align="left">
                                      Dear <b>'.$fullname.',</b><br><br>

                                      <div style="text-align: justify;color: #fff;">I hope this email finds you well..<b></div><br>

                                      <div style="text-align: justify;color: #fff;">I am writing to inform you that your user credentials for our counseling service have been successfully created. You can now access our counseling platform using the following credentials::</div><br>

                                      <div style="text-align: justify;color: #fff;">Username: '.$username.'<br>Password: '.$password.'</div>

                                      <div style="text-align: justify;color: #fff;"><br>Please take a moment to log in and familiarize yourself with our systems. For security reasons, we recommend changing your password upon your first login. If you encounter any issues or have questions about the login process.</div><br>

                                      <div style="text-align: justify;color: #fff;">Please keep these credentials secure and do not share them with anyone else. We take the privacy and confidentiality of our clients very seriously.</div><br>

                                      <div style="text-align: justify;color: #fff;">With your user credentials, you will be able to schedule counseling sessions, access resources, and communicate with your counselor.</div><br>

                                      <div style="text-align: justify;color: #fff;">If you encounter any issues or have any questions regarding your user credentials or the counseling service, please do not hesitate to contact us at <a href="https://chcs.workfoliohumanresource.com">chcs.workfoliohumanresource.com</a></div><br>

                                      <div style="text-align: justify;color: #fff;">We are committed to providing you with the support you need on your journey towards personal growth and well-being.</div><br>

                                      <div style="text-align: justify;color: #fff;">Thank you for choosing our counseling service.</div><br>

                                      <b style="color:#fff">Warm regards,</b><br><br>

                                      <b style="color:#fff">Workfolio Team</b><br>
                                      <b style="color:#fff">WORKFOLIO HUMAN RESOURCE</b><br>
                                    </p>
                                    <table class="s-4 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                      <tbody>
                                        <tr>
                                          <td style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;background: #8AB6F9;" align="left" width="100%" height="16">
                                            &#160;
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <table class="btn btn-primary p-3 fw-700" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; font-weight: 700 !important;">
                                      <tbody>
                                        <tr>
                                          <!--<td style="line-height: 24px; font-size: 16px; border-radius: 6px; font-weight: 700 !important; margin: 0;" align="center" bgcolor="#0d6efd">
                                            <a href="https://app.bootstrapemail.com/templates" style="color: #ffffff; font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 6px; line-height: 20px; display: block; font-weight: 700 !important; white-space: nowrap; background-color: #0d6efd; padding: 12px; border: 1px solid #0d6efd;">Visit Website</a>
                                          </td>-->
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                              <tbody>
                                <tr>
                                  <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40">
                                    &#160;
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                              <tbody>
                                <tr>
                                </tr>
                              </tbody>
                            </table>
                            <table class="s-6 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                              <tbody>
                                <tr>
                                  <td style="line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;" align="left" width="100%" height="24">
                                    &#160;
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="text-muted text-center" style="color: #718096;" align="center">
                              Sent from Workfolio Human Resource <br><br>
                            </div>
                            <table class="s-6 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                              <tbody>
                                <tr>
                                  <td style="line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;" align="left" width="100%" height="24">
                                    &#160;
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                  									</tr>
                								</tbody>
              								</table>
                    									<![endif]-->
                 						 			</td>
                								</tr>
             						 		</tbody>
            							</table>
          							</td>
        						</tr>
      						</tbody>
    					</table>
  					</body>
  					</html>
  					'; // Update with your email content
  					$mail->Body = $html_body;
                    // Send email
                    $mail->send();
                    
                    // Update status
                    $addservice['success'] = true;
                    $addservice['message'] = 'New counselling services added & new mentor was appointed';
                } catch (Exception $e) {
                    $addservice['message'] = $e->getMessage();
                }
			} else {
    			// Handle error
    			$addservice['message'] = "Error executing SQL queries: " . $connection->error;
			}
        }
    }
}

// Function to generate random string
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['result' => $addservice]);

?>
