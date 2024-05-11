<?php
// Database connection parameters
require_once 'config.php';

// Create connection
$config = new config();
$connection = $config->getConnection();

// Check if search query is submitted via POST
if (isset($_POST['search_query'])) {
    // Get search query
    $searchQuery = $_POST['search_query'];

    // Prepare SQL statement to search for articles
    $sql = "SELECT * FROM health_wellness_arc WHERE hwarticle_title LIKE '%$searchQuery%'";

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
                        <img src="images_article/'.$row['hwarticle_image'].'" class="card-img-top" style="width:285px">
                    </center>
                    <div class="card-body">
                        <h5 class="card-title text-truncate" style="width:250">'.$row['hwarticle_title'].'</h5>
                        <p class="card-text">Date Posted: '.date("F j, Y", strtotime($row['hwpublication_date'])).'</p>

                        <button type="button" class="btn btn-success" data-hwid1="'.$row['hwarticle_id'].'" data-hwtitle1="'.$row['hwarticle_title'].'" data-hwauthor1="'.$row['hwarticle_author'].'" data-bs-toggle="modal" data-bs-target="#article-editor-m">Edit</button>

                        <button type="button" class="btn btn-primary" data-hwid2="'.$row['hwarticle_id'].'" data-hwtitle2="'.$row['hwarticle_title'].'" data-hwauthor2="'.$row['hwarticle_author'].'" data-hwaimagecontent2="'.$row['hwarticle_image_content'].'" data-hwposted2="'.$row['hwpublication_date'].'" data-bs-toggle="modal" data-bs-target="#article-viewer-m">View</button>
                        
                        <button type="button" class="btn btn-danger" id="delete-article" data-hwid3="'.$row['hwarticle_id'].'">Delete</button>
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
