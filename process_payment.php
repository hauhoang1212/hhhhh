<?php
session_start();
include('lket.php'); // Đảm bảo bạn đã kết nối với cơ sở dữ liệu

// Kiểm tra nếu giỏ hàng không rỗng
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "Giỏ hàng của bạn đang trống!";
    exit;
}

// Lấy thông tin giỏ hàng
$cart = $_SESSION['cart']; 
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Lấy thông tin người dùng từ form thanh toán
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Thực hiện thêm đơn hàng vào bảng 'ttkh' (tên bảng có thể là 'orders' hoặc tên khác tùy theo cấu trúc cơ sở dữ liệu của bạn)
$query = "INSERT INTO ttkh (fullname, phone, address, total) VALUES ('$fullname', '$phone', '$address', '$total')";
if (mysqli_query($conn, $query)) {
    // Lấy ID của đơn hàng vừa tạo
    $order_id = mysqli_insert_id($conn);

    // Thêm chi tiết đơn hàng vào bảng 'chitietdh'
    foreach ($cart as $item) {
        $product_name = $item['name'];
        $product_price = $item['price'];
        $product_quantity = $item['quantity'];
        $product_total = $item['price'] * $item['quantity'];

        // Nếu bạn không cần chèn hình ảnh, bạn có thể bỏ qua cột 'image'
        $query_details = "INSERT INTO chitietdh (order_id, product_name, price, quantity, total) 
                          VALUES ('$order_id', '$product_name', '$product_price', '$product_quantity', '$product_total')";
        mysqli_query($conn, $query_details);
    }

    // Đơn hàng đã được xử lý, chuyển hướng tới trang cảm ơn
    header("Location: thank_you.php?order_id=$order_id");
    exit;
} else {
    echo "Lỗi khi xử lý đơn hàng: " . mysqli_error($conn);
}
?>
