<?php

$recent_blog_query = mysqli_query($db_connet, "SELECT blogs.id, admins.name, blogs.title, blogs.description, blogs.cover_image, blogs.created_at FROM blogs INNER JOIN admins ON blogs.user_id = admins.id ORDER BY `id` DESC LIMIT 4 ");

function slug($str) { 
    
    $str = strtolower($str); 
    $str = str_replace(' ', '-', $str); 
    $str = trim($str, '-'); 
    return $str; 
} 

?>

<div class="row">
    <div class="d-flex flex-column row-gap-3">
        <?php while($recent_blog = mysqli_fetch_assoc($recent_blog_query)){ 
            if($blog_id != $recent_blog['id']){ ?> 
            
            <div class="recent-blog w-100">
                <div class="card blog-container">
                    <img src="uploads/<?= $recent_blog['cover_image']; ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <div>
                            <span class="fw-semibold"><?= $recent_blog['name']; ?> | <?= date('d M, Y',strtotime($recent_blog['created_at'])); ?></span>
                        </div>
                        
                        <h5 class="card-title"><?= mb_strimwidth($recent_blog['title'], 0, 42, "..."); ?></h5>
                        <p class="card-text"><?= mb_strimwidth($recent_blog['description'], 0, 87, "..."); ?> </p>
                        <a href="blog_detail.php?blog_name=<?= slug($recent_blog['title']); ?>&blog_id=<?= $recent_blog['id']; ?>" class="btn btn-primary">Read the Article</a>
                    </div>
                </div>
            </div>

        <?php } } ?>
    </div>
</div>
