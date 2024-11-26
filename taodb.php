<?php
    // kết nổi Database
    include "lket.php";
    //tạo db
    $sql = " CREATE DATABASE  trangweb2";

    if( mysqLi_query ($conn,$sql) ){
             echo "Tạo db thanhg cong";
    }
    else{
   echo"thatbai";
    }
   

?>