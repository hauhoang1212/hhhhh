<?php
session_start();
session_destroy(); // Xóa tất cả dữ liệu session
header("Location: trangchu.php");
exit();
?>
