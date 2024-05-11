<?php
// Database connection parameters
require_once 'config.php';

// Create connection
$config = new config();
$connection = $config->getConnection();

// Check if search query is submitted via POST
if (isset($_POST['search_program'])) {
    // Get search query
    $searchQuery = $_POST['search_program'];

    // Prepare SQL statement to search for articles
    $sql = "SELECT * FROM health_wellness_program WHERE hwprogram_name LIKE '%$searchQuery%'";

    // Execute SQL statement
    $result = $connection->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <center>
                        <img src="images_programs/'.$row['hwprogram_image'].'" class="card-img-top" style="width:285px">
                    </center>
                    <div class="card-body">
                        <h5 class="card-title text-truncate" style="width:250">'.$row['hwprogram_name'].'</h5>
                        <p class="card-text">Date Posted: '.date("F j, Y", strtotime($row['hwprogram_posted'])).'</p>

                        <button type="button" class="btn btn-success" data-progid1="'.$row['hwprogram_id'].'" data-progname1="'.$row['hwprogram_name'].'" data-progorg1="'.$row['hwprogram_organizer'].'" data-bs-toggle="modal" data-bs-target="#program-editor-m">Edit</button>

                        <button type="button" class="btn btn-primary" data-progid2="'.$row['hwprogram_id'].'" data-progname2="'.$row['hwprogram_name'].'" data-progorg2="'.$row['hwprogram_organizer'].'" data-prognimagecontent2="'.$row['hwprogram_image_content'].'" data-progposted2="'.$row['hwprogram_posted'].'" data-bs-toggle="modal" data-bs-target="#program-viewer-m">View</button>
                        
                        <button type="button" class="btn btn-danger" id="delete-article" data-progid3="'.$row['hwprogram_id'].'">Delete</button>
                    </div>
                </div>
            </div>
            ';
        }
    } else {
        ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>No Result Found!</h4>
                </div>
            </div>
        </div>
        <?php
    }
}

?>
