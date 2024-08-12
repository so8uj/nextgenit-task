<?php 

    require_once('header.php'); 
    require_once('core/db.php'); 
    $admn_id = $admin_data['id'];
    $my_blog_query = mysqli_query($db_connet,"SELECT COUNT(*) as `my_blogs` FROM `blogs` WHERE `user_id` = '$admn_id'");
    $my_blog_count = mysqli_fetch_assoc($my_blog_query);


?>


    <div class="main-content">
        <div class="container">
            <div class="row">

                <?php require_once('sidebar.php'); ?>


                <div class="col-lg-10">
                    <h2>Welcome, <?= $admin_data['name']; ?></h2>
                    
                    <div class="row mt-4">
                        <div class="col-lg-4">
                            <div class="card p-4">
                                <h3>My Blogs</h3>
                                <h3 class="mb-0"><?= $my_blog_count['my_blogs']; ?></h3>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


<?php require_once('footer.php'); ?>