<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Lấy thông tin sản phẩm từ request
$id = intval($_POST['id']);
$tensp = htmlspecialchars($_POST['name']);
$gia = floatval($_POST['price']);
$hinh_anh = htmlspecialchars($_POST['image']);
$quantity = intval($_POST['quantity']);

// Kiểm tra nếu sản phẩm đã có trong giỏ hàng
if (isset($_SESSION['cart'][$id])) {
    // Nếu có, cập nhật số lượng
    $_SESSION['cart'][$id]['quantity'] += $quantity;
} else {
    // Nếu không, thêm sản phẩm vào giỏ hàng
    $_SESSION['cart'][$id] = [
        'name' => $tensp,
        'price' => $gia,
        'image' => $hinh_anh,
        'quantity' => $quantity
    ];
}

// Chuyển hướng người dùng về trang giỏ hàng
header("Location: cart.php");
exit;

?>
