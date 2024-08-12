<?php 

function fileUpload($tmp_name,$img_ex,$path,$delete=null){

    $location = $_SERVER['DOCUMENT_ROOT'].'/nextgenit-task';
    if($delete != null){
        if(file_exists($location.$path.$delete)){
            unlink($location.$path.$delete);
        }
    }
    $new_name = 'blog-image-'.rand(0,99).time().'.'.$img_ex;
    move_uploaded_file($tmp_name,$location.$path.$new_name);
    return $new_name;
}

function fileDelete($file,$path){
    $location = $_SERVER['DOCUMENT_ROOT'].'/nextgenit-task';
    if(file_exists($location.$path.$file)){
        unlink($location.$path.$file);
    }
}