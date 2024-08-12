<?php
    
    if($page_name == 'index.php'){
        echo "Admin Dashboard";
    }elseif($page_name == 'add_blog.php'){
        echo 'Admin - Add Blog';
    }elseif($page_name == 'blogs.php'){
        echo 'Admin - Manage Blogs';
    }

?>