<?php

if (isset($_GET['option'])) {
    switch ($_GET['option']) {
        case 'showproducts':
            include 'showproducts.php';
            break;
    }
} else {
    include"trangchu.php";
}
?>