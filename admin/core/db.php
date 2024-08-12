<?php  

    $db_host = "localhost";
    $db_name = "nextgenit_blog";
    $db_user = "root";
    $db_pass = "";

    $db_connet = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    if (!$db_connet){
        die ('Failed to connect with server');
    }

?>
