<?php
require_once('db.php');
require_once('fileUpload.php');

// Add Image
if(isset($_POST['add_form'])){
    $output = array();
    $blog_id = $_POST['blog_id'];
    $cnt = $_POST['cnt_id'] + 1;
    if($_FILES['featured_images']['name'] != null){
    
        foreach($_FILES["featured_images"]["name"] as $key=>$featured_img_name){
            $img_ex = pathinfo($featured_img_name, PATHINFO_EXTENSION);
            $tmp_name = $_FILES['featured_images']['tmp_name'][$key];
            $featured_image = fileUpload($tmp_name,$img_ex,'/uploads/');

            $featured_image_upload = mysqli_query($db_connet,"INSERT INTO `blog_featured_images` (`blog_id`, `image`) VALUES ('$blog_id','$featured_image')");
            $feature_image_id = mysqli_insert_id($db_connet);


            $html = '<div class="col-lg-6" id="main' . $feature_image_id . '">
                    <img src="../uploads/' . $featured_image . '" alt="Blog Image" width="100%" class="img-thumbnail mb-3" id="image' . $feature_image_id . '">
                    <form class="featuredImageForm" id="FeaturedImageForm' . $feature_image_id . '" enctype="multipart/form-data">
                        <input type="hidden" name="feature_image_id" value="' . $feature_image_id . '">
                        <input type="hidden" name="old_feature_image" value="' . $featured_image . '">
                        <label for="feature_image" class="form-label">Update Featured Image ' . $cnt . '</label>
                        <input type="file" name="feature_image" class="form-control mb-2" id="feature_image" required>
                        <button class="btn btn-warning btn-sm submitForm" data-form-target="FeaturedImageForm' . $feature_image_id . '">Update</button>
                        <button data-img-delete="' . $feature_image_id . '_' . $featured_image . '" class="btn btn-danger btn-sm delete_image" type="button">Delete Image</button>
                    </form>
                </div>';

            array_push($output,$html);
            sleep(1);
        }
    }
    echo implode('', $output);
    mysqli_close($db_connet);

}

// Update Image
if(isset($_POST['feature_image_id'])){
    $feature_image_id = $_POST['feature_image_id'];
    $old_feature_image = $_POST['old_feature_image'];

    if($_FILES['feature_image']['name'] != null){
        $feature_image = $_FILES['feature_image']['name'];
        $img_ex = pathinfo($feature_image, PATHINFO_EXTENSION);
        $feature_image = fileUpload($_FILES['feature_image']['tmp_name'],$img_ex,'/uploads/',$old_feature_image);
    }

    mysqli_query($db_connet, "UPDATE `blog_featured_images` SET `image`='$feature_image' WHERE `id`='$feature_image_id'");

    echo $feature_image_id.'_'.$feature_image;
    mysqli_close($db_connet);

}

// Delete Image
if(isset($_POST['img_id'])){

    $img_id = $_POST['img_id'];
    $img_id_explode = explode('_',$img_id);
    $id = $img_id_explode[0];
    $img = $img_id_explode[1];
    $delete = mysqli_query($db_connet,"DELETE FROM `blog_featured_images` WHERE `id`='$id'");
    if($delete == true){
        fileDelete($img,'/uploads/');
        echo $id;
    }
    mysqli_close($db_connet);

}
