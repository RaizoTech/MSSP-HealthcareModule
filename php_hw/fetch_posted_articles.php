<?php
require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

// Set the timezone to Philippines
date_default_timezone_set('Asia/Manila');

$sql = "SELECT * FROM health_wellness_arc";
$result = $connection->query($sql);

$foundMatchingDate = false; // Flag to track if any item matches the current date

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $datadate = strtotime($row['hwpublication_date']); // Convert to timestamp for accurate comparison
        $dataformatshit = date("F d, Y", $datadate);
        $currentDate = strtotime(date('Y-m-d')); // Get current date as timestamp

        // Check if the publication date matches the current date and no other match has been found yet
        if ($datadate === $currentDate && !$foundMatchingDate) {
            $colClass = 'col-lg-12'; // Use col-lg-12 if it's the first item matching the current date
            $foundMatchingDate = true; // Set the flag to true to indicate we found a matching date
        } else {
            $colClass = 'col-lg-6'; // Use col-lg-6 for other items
        }
?>
        <div class="<?php echo $colClass; ?>">
            <!-- Blog layout #1 with image -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><a href="#" class="text-body"><?php echo $row['hwarticle_title'] ?></a></h5>
                </div>
                <div class="card-body">
                    <div class="card-img-actions mb-3">
                        <img class="card-img img-fluid" src="images_article/<?php echo $row['hwarticle_image_content'] ?>" alt="">
                        <div class="card-img-actions-overlay card-img">
                            <a href="#" class="btn btn-outline-white btn-icon rounded-pill">
                                <i class="ph-link"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                    <?php echo $row['hwarticle_content']; ?>    
                    </div>
                </div>
                <div class="card-body d-sm-flex justify-content-sm-between align-items-sm-center pt-0">
                    <ul class="list-inline list-inline-bullet text-muted mb-3 mb-sm-0">
                        <li class="list-inline-item">By <a href="#" class="text-body"><?php echo $row['hwarticle_author'] ?></a></li>
                        <li class="list-inline-item"><?php echo $dataformatshit; ?></li>
                    </ul>
                </div>
            </div>
        </div>
<?php
    }
}

?>
