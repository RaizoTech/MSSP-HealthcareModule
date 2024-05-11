<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dropdown Item Click</title>
<!-- Include Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
    <div class="dropdown w-100 w-sm-auto">
        <a href="#" class="d-flex align-items-center text-body lh-1 dropdown-toggle py-sm-2" data-bs-toggle="dropdown" data-bs-display="static">
            <img src="assets1/images/brands/tesla.svg" class="w-32px h-32px me-2" alt="">
            <div class="me-auto me-lg-1">
                <div class="fs-sm text-muted mb-1">Customer</div>
                <div class="fw-semibold">Tesla Motors Inc</div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg-end w-100 w-lg-auto wmin-300 wmin-sm-350 pt-0">
            <div class="d-flex align-items-center p-3">
                <h6 class="fw-semibold mb-0">Customers</h6>
                <a href="#" class="ms-auto">
                    View all
                    <i class="ph-arrow-circle-right ms-1"></i>
                </a>
            </div>
            <a href="#" class="dropdown-item active py-2">
                <img src="assets1/images/brands/tesla.svg" class="w-32px h-32px me-2" alt="">
                <div>
                    <div class="fw-semibold">Tesla Motors Inc</div>
                    <div class="fs-sm text-muted">42 users</div>
                </div>
            </a>
            <a href="#" class="dropdown-item py-2">
                <img src="assets1/images/brands/debijenkorf.svg" class="w-32px h-32px me-2" alt="">
                <div>
                    <div class="fw-semibold">De Bijenkorf</div>
                    <div class="fs-sm text-muted">49 users</div>
                </div>
            </a>
            <a href="#" class="dropdown-item py-2">
                <img src="assets1/images/brands/klm.svg" class="w-32px h-32px me-2" alt="">
                <div>
                    <div class="fw-semibold">Royal Dutch Airlines</div>
                    <div class="fs-sm text-muted">18 users</div>
                </div>
            </a>
            <a href="#" class="dropdown-item py-2">
                <img src="assets1/images/brands/shell.svg" class="w-32px h-32px me-2" alt="">
                <div>
                    <div class="fw-semibold">Royal Dutch Shell</div>
                    <div class="fs-sm text-muted">54 users</div>
                </div>
            </a>
            <a href="#" class="dropdown-item py-2">
                <img src="assets1/images/brands/bp.svg" class="w-32px h-32px me-2" alt="">
                <div>
                    <div class="fw-semibold">BP plc</div>
                    <div class="fs-sm text-muted">23 users</div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){
    // Add click event handler to dropdown items
    $('.dropdown-item').click(function(e){
        e.preventDefault();
        // Get the value and icon source of the clicked dropdown item
        var value = $(this).data('value');
        var iconSrc = $(this).find('img').attr('src');
        // Update the text and icon of the main dropdown button
        $('.dropdown-toggle .fw-semibold').text(value);
        $('.dropdown-toggle img').attr('src', iconSrc);
    });
});
</script>


</body>
</html>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <center>
                    <img src="images_article/1_mN17ZOBWqn-r3DHSsaUBxw.webp" class="card-img-top" style="width:285px">
                </center>
                <div class="card-body">
                    <h5 class="card-title text-truncate" style="width:250px;">
                        Finding Balance: Tips for Balancing Work and Health Lifestyle
                    </h5>
                    <p class="card-text">Date Posted: 2023-10-16</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#article-editor-m">Edit</button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#article-viewer-m">View</button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#article-delete-m">Delete</button>
                </div>
            </div>
        </div>
<div class="card-body">
                        <h5 class="card-title text-truncate" style="width:250">'.$row['hwarticle_title'].'</h5>
                        <p class="card-text">Date Posted: '.date("F j, Y", strtotime($row['hwpublication_date'])).'</p>

                        <button type="button" class="btn btn-success" data-hwid1="'.$row['hwarticle_id'].'" data-hwtitle1="'.$row['hwarticle_title'].'" data-hwdescription1=" data-hwauthor1="'.$row['hwarticle_author'].'" data-bs-toggle="modal" data-bs-target="#article-editor-m">Edit</button>

                        <button type="button" class="btn btn-primary" data-hwid2="'.$row['hwarticle_id'].'" data-hwtitle2="'.$row['hwarticle_title'].'" data-hwcontent2=" data-hwauthor2="'.$row['hwarticle_author'].'" data-hwposted2="'.$row['hwpublication_date'].'" data-bs-toggle="modal" data-bs-target="#article-viewer-m">View</button>
                        
                        <button class="btn btn-danger" data-hwid3="'.$row['hwarticle_id'].'" data-bs-toggle="modal" data-bs-target="#article-delete-m">Delete</button>
                    </div>