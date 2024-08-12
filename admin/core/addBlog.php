<?php

require_once('db.php');
require_once('fileUpload.php');

$user_id = $_POST['user_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$main_string_report = str_replace("'", "''", $description);


if($_FILES['cover_image']['name'] != null){
    $cover_image = $_FILES['cover_image']['name'];
    $img_ex = pathinfo($cover_image, PATHINFO_EXTENSION);
    $cover_image = fileUpload($_FILES['cover_image']['tmp_name'],$img_ex,'/uploads/');
}

$insert_blog_query = mysqli_query($db_connet, "INSERT INTO `blogs` (`user_id`, `title`, `description`, `cover_image`) VALUES ('$user_id','$title','$main_string_report','$cover_image')");

if($insert_blog_query == true){

    $blog_id = mysqli_insert_id($db_connet);

    if($_FILES['featured_images']['name'][0] != null){
    
        foreach($_FILES["featured_images"]["name"] as $key=>$featured_img_name){
            $img_ex = pathinfo($featured_img_name, PATHINFO_EXTENSION);
            $tmp_name = $_FILES['featured_images']['tmp_name'][$key];
            $featured_image = fileUpload($tmp_name,$img_ex,'/uploads/');
            $featured_image_upload = mysqli_query($db_connet,"INSERT INTO `blog_featured_images` (`blog_id`, `image`) VALUES ('$blog_id','$featured_image')");
            sleep(1);
        }
    }
    mysqli_close($db_connet);
    

}else{
    echo "Somthing Went Wrong!";
    die();
}


