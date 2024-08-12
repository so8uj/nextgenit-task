<?php

require_once('db.php');

$email = $_POST['email'];
$password = $_POST['password'];

$check_email_query = mysqli_query($db_connet, "SELECT * FROM `admins` WHERE `email` = '$email'");

if($check_email_query != true){
    echo "Connection Error";
    die();
}else{

    $check_email = mysqli_num_rows($check_email_query);

    if($check_email > 0){
        $admin_data = mysqli_fetch_assoc($check_email_query);
        if(password_verify($password,$admin_data['password'])){
            session_start();
            $_SESSION['admin_data'] = $admin_data;
            mysqli_close($db_connet);
        }else{
            echo "Invalid Password!";
            die();
        }
    }else{
        echo "Invalid Email!";
        die();
    }
}
