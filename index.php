<?php 

    require_once('header.php'); 
    require_once('admin/core/db.php'); 
    $latest_blogs = mysqli_query($db_connet,"SELECT blogs.id, admins.name, blogs.title, blogs.description, blogs.cover_image, blogs.created_at FROM blogs INNER JOIN admins ON blogs.user_id = admins.id ORDER BY `id` DESC");

    function slug($str) { 
    
        $str = strtolower($str); 
        $str = str_replace(' ', '-', $str); 
        $str = trim($str, '-'); 
        return $str; 
    } 

?>

    <section class="latest-blogs">
        <div class="container">
            <h1 class="text-center mb-5">Latest Blogs</h1>

            <div class="row row-gap-4">
                <?php while($latest_blog = mysqli_fetch_assoc($latest_blogs)) { ?> 
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card blog-container">
                            <img src="uploads/<?= $latest_blog['cover_image']; ?>" class="card-img-top" alt="">
                            <div class="card-body">
                                <div>
                                    <span class="fw-semibold"><?= $latest_blog['name']; ?> | <?= date('d M, Y',strtotime($latest_blog['created_at'])); ?></span>
                                </div>
                                
                                <h5 class="card-title"><?= mb_strimwidth($latest_blog['title'], 0, 42, "..."); ?></h5>
                                <p class="card-text"><?= mb_strimwidth($latest_blog['description'], 0, 87, "..."); ?> </p>
                                <a href="blog_detail.php?blog_name=<?= slug($latest_blog['title']); ?>&blog_id=<?= $latest_blog['id']; ?>" class="btn btn-primary">Read the Article</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                

            </div>
        </div>
    </section>

<?php require_once('footer.php'); ?>




    