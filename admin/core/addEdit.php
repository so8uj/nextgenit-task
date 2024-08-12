<?php

require_once('db.php');
require_once('fileUpload.php');

$blog_id = $_POST['blog_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$old_image = $_POST['old_image'];
$main_string_report = str_replace("'", "''", $description);

// print_r($_FILES);
if($_FILES['cover_image']['name'] != null){
    $cover_image = $_FILES['cover_image']['name'];
    $img_ex = pathinfo($cover_image, PATHINFO_EXTENSION);
    $cover_image = fileUpload($_FILES['cover_image']['tmp_name'],$img_ex,'/uploads/',$old_image);
}else{
    $cover_image = $old_image;
}

$insert_blog_query = mysqli_query($db_connet, "UPDATE `blogs` SET `title`='$title',`description`='$main_string_report',`cover_image`='$cover_image' WHERE `id` = '$blog_id'");

if($insert_blog_query != true){
    echo "Somthing Went Wrong!";
    die();
}else{
    mysqli_close($db_connet);
}


