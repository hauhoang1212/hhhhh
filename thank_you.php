<?php
// Kiểm tra xem có ID đơn hàng không (được truyền qua URL)
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

if ($order_id) {
    // Thực hiện các thao tác liên quan đến đơn hàng (nếu cần)
    // Ví dụ: Lấy thông tin đơn hàng từ cơ sở dữ liệu, v.v.
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn bạn!</title>
    <meta http-equiv="refresh" content="3;url=trangchu.php"> <!-- Tự động chuyển hướng về trang chủ sau 3 giây -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 text-center">
    <h1 class="mb-4">Cảm ơn bạn đã thanh toán!</h1>
    <p>Đơn hàng của bạn đã được xử lý thành công. Bạn sẽ được chuyển về trang chủ trong vài giây.</p>
    <p>Mã đơn hàng của bạn: <strong><?= htmlspecialchars($order_id) ?></strong></p>
    <a href="trangchu.php" class="btn btn-primary mt-3">Trở về trang chủ ngay lập tức</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
