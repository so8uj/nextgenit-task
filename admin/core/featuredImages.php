<?php 
    require_once('db.php');
    $blog_id = $_GET['blog_id'];
    $featured_images_query = mysqli_query($db_connet,"SELECT * FROM `blog_featured_images` WHERE `blog_id` = '$blog_id'");
    
?>

<div class="row dynamic-added-image">
    <?php $cnt=1; while($feature_iamge = mysqli_fetch_assoc($featured_images_query)){ ?> 
        <div class="col-lg-6" id="main<?= $feature_iamge['id']; ?>">

            <img src="../uploads/<?= $feature_iamge['image']; ?>" alt="Blog Image" width="100%" class="img-thumbnail mb-3" id="image<?= $feature_iamge['id'] ?>">

            <form class="featuredImageForm" id="FeaturedImageFrom<?= $feature_iamge['id'] ?>" enctype="multipart/form-data">

                <input type="hidden" name="feature_image_id" value="<?= $feature_iamge['id']; ?>">
                <input type="hidden" name="old_feature_image" value="<?= $feature_iamge['image']; ?>">

                <label for="feature_image" class="form-label">Update Featured Image <?= $cnt; ?></label>
                <input type="file" name="feature_image" class="form-control mb-2" id="feature_image" required>
                
                <button class="btn btn-warning btn-sm submitFrom" data-form-target="FeaturedImageFrom<?= $feature_iamge['id'] ?>">Update</button>
                <button data-img-delete="<?= $feature_iamge['id'].'_'.$feature_iamge['image']; ?>" class="btn btn-danger btn-sm delete_image" type="button">Delete Image</button>
            </form>

        </div>
    <?php $cnt++; } ?>
</div><hr>
<div class="row">
    <div class="col-lg-12">
        <form id="addFeaturedImage" enctype="multipart/form-data">
            <input type="hidden" name="blog_id" value="<?= $blog_id; ?>">
            <input type="hidden" name="cnt_id" value="<?= $cnt; ?>">
            <input type="hidden" name="add_form" value="add">
            <div class="mb-3">
                <label for="featured_images" class="form-label">Add New Feature Images</label>
                <input type="file" name="featured_images[]" class="form-control" id="featured_images" multiple required>
                <strong>You can add Multiple Featured Image</strong>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Add New Images</button>
        </form>
    </div>
</div>

