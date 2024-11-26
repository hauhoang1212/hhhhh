<?php
session_start();

// Kiểm tra xem giỏ hàng có tồn tại không
if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $id = intval($_POST['id']);
    $quantity = intval($_POST['quantity']);
    
    // Cập nhật số lượng sản phẩm trong giỏ hàng
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] = $quantity;
    }
}

// Chuyển hướng lại trang giỏ hàng
header("Location: cart.php");
exit;
?>
