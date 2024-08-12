<?php

    require_once('admin/core/db.php');
    if(isset($_GET['blog_id'])){

        $blog_id = $_GET['blog_id'];
        $single_blog_query = mysqli_query($db_connet, "SELECT blogs.id, admins.name, blogs.title, blogs.description, blogs.cover_image, blogs.created_at FROM blogs INNER JOIN admins ON blogs.user_id = admins.id WHERE blogs.id='$blog_id'");

        if(!mysqli_num_rows($single_blog_query) > 0){
            header("Location: index.php");
        }
        $single_blog = mysqli_fetch_assoc($single_blog_query);
        $blog_title = $single_blog['title'];
        
        $featured_images_query = mysqli_query($db_connet,"SELECT * FROM `blog_featured_images` WHERE `blog_id` = '$blog_id'");
        $feature_image_count = mysqli_num_rows($featured_images_query);
    }else{
        header("Location: index.php");
    }
    require_once('header.php');
?>

<section class="detail-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="d-flex flex-column row-gap-2 mt-4 pt-3">
                    <img src="https://placehold.co/200x150?text=Add+1" class="w-100" alt="">
                    <img src="https://placehold.co/200x150?text=Add+2" class="w-100" alt="">
                    <img src="https://placehold.co/200x150?text=Add+3" class="w-100" alt="">
                </div>
            </div>

            <div class="col-lg-6">

                <h5 class="mb-3">Author: <?= $single_blog['name']; ?>  | Update: <?= date('d M, Y',strtotime($single_blog['created_at'])); ?></h5>

                <div class="image-carousel">
                    <div id="carouselExampleIndicators" class="carousel slide">
                        
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="uploads/<?= $single_blog['cover_image']; ?>" class="d-block w-100" alt="<?= $single_blog['title'] ?>">
                            </div>

                            <?php if($feature_image_count > 0){ 
                                while($feature_image = mysqli_fetch_assoc($featured_images_query)) { ?>
                                
                                <div class="carousel-item">
                                    <img src="uploads/<?= $feature_image['image']; ?>" class="d-block w-100" alt="<?= $single_blog['title'] ?>">
                                </div>
                                
                            <?php } } ?>

                        </div>
                        <?php if($feature_image_count > 0){ ?>
                            
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            
                        <?php } ?>
                    </div>
                </div>

                <h1 class="my-3"><?= $single_blog['title'] ?></h1>

                <div class="description">
                    <?= $single_blog['description']; ?>
                </div>

            </div>

            <div class="col-lg-3">
                <h3 class="mt-4 pt-3">Recent Blogs</h3>
                <hr>
                <?php require_once('recent_blogs.php') ?>

            </div>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>