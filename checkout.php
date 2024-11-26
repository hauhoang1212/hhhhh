<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: login.html");
    exit();
}

// Nếu đã đăng nhập, cho phép tiếp tục mua hàng
echo "Xin chào, " . $_SESSION['user_name'] . "! Bạn có thể mua hàng.";
?>


