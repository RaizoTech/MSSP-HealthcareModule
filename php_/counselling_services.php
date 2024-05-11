<?php
require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$sql = "SELECT counselling_service.`service_id`, counselling_service.`service_logo`, counselling_service.`service_description`, counselling_service.`service_name`, COUNT(counselling_appointment.`service_id`) AS appointment_count FROM counselling_service LEFT JOIN counselling_appointment ON counselling_service.`service_id` = counselling_appointment.`service_id` GROUP BY counselling_service.`date_created` ASC";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <a href="#" class="dropdown-item py-2" id="dropdown-item1" data-idservices="<?php echo $row['service_id'] ?>">
            <img src="images_counselling_services/<?php echo $row['service_logo'] ?>" id="services-logo" class="w-32px h-32px me-2" alt="">
            <div>
                <!-- Hide the input field with CSS -->
                <input type="hidden" id="content-services" name="" value="<?php echo htmlspecialchars($row['service_description']) ?>">
                <div class="fw-semibold services-name"><?php echo $row['service_name'] ?></div>
                <div class="fs-sm text-muted"><?php echo $row['appointment_count'] ?> Total of Appointments</div>
            </div>
        </a>
        <?php
    }
} else {
    ?>
    <a href="#" class="dropdown-item active py-2" id="dropdown-item1">
        <img src="assets1/images/brands/images.jpg" id="services-logo" class="w-32px h-32px me-2" alt="">
        <div>
            <div class="fw-semibold services-name">No services available</div>
        </div>
    </a>
    <?php
}
?>
