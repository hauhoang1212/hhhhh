<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'webcuatoi';
    
    $conn = new mysqLi($server, $user,  $pass, $database );

    if($conn)
    {
        mysqLi_query($conn, "SET NAMES 'utf8' ");
        echo '';
        echo '<br>';
    }
    else{
        echo'kết nối thất bại';     
    }

    
?>