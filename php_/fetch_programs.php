<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$sql = "SELECT * FROM health_wellness_program";

$result = $connection->query($sql);

if($result->num_rows > 0){

	while($row = $result->fetch_assoc()){

		echo '
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <center>
                        <img src="images_programs/'.$row['hwprogram_image'].'" class="card-img-top" style="width:285px">
                    </center>
                    <div class="card-body">
                        <h5 class="card-title text-truncate" style="width:250">'.$row['hwprogram_name'].'</h5>
                        <p class="card-text">Date Posted: '.date("F j, Y", strtotime($row['hwprogram_posted'])).'</p>

                        <button type="button" class="btn btn-success" data-progid1="'.$row['hwprogram_id'].'" data-progname1="'.$row['hwprogram_name'].'" data-progorg1="'.$row['hwprogram_organizer'].'" data-bs-toggle="modal" data-bs-target="#article-editor-m">Edit</button>

                        <button type="button" class="btn btn-primary" data-progid2="'.$row['hwprogram_id'].'" data-progname2="'.$row['hwprogram_name'].'" data-progorg2="'.$row['hwprogram_organizer'].'" data-prognimagecontent2="'.$row['hwprogram_image_content'].'" data-progposted2="'.$row['hwprogram_posted'].'" data-bs-toggle="modal" data-bs-target="#program-viewer-m">View</button>
                        
                        <button type="button" class="btn btn-danger" id="delete-article" data-progid3="'.$row['hwprogram_id'].'">Delete</button>
                    </div>
                </div>
            </div>
        ';

	}

}else{
    ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>No Health & Wellness Programs yet!</h4>
                </div>
            </div>
        </div>
        <?php
}

?>