<?php 
require_once('db.php');
require_once('fileUpload.php');

$blog_id = $_POST['blog_id'];
$cover_image = $_POST['cover_image'];

$get_all_featured_images = mysqli_query($db_connet,"SELECT * FROM `blog_featured_images` WHERE `blog_id` = '$blog_id'");

$delete_blog = mysqli_query($db_connet,"DELETE FROM `blogs` WHERE `id` = '$blog_id'");

if($delete_blog == true){
    fileDelete($cover_image,'/uploads/');
    while($feature_image = mysqli_fetch_assoc($get_all_featured_images)){
        $feature_image_id = $feature_image['id'];
        mysqli_query($db_connet,"DELETE FROM `blog_featured_images` WHERE `id`='$feature_image_id'");
        fileDelete($feature_image['image'],'/uploads/');
    }
}
echo $blog_id;
// mysqli_close($db_connet);



?>