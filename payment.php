<?php
session_start();
include('lket.php'); // Đảm bảo bạn đã kết nối với cơ sở dữ liệu

// Kiểm tra nếu giỏ hàng không rỗng
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "<div class='alert alert-warning'>Giỏ hàng của bạn đang trống!</div>";
    exit;
}

// Lấy thông tin giỏ hàng
$cart = $_SESSION['cart']; // Giả sử giỏ hàng đã lưu trong session
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Thanh toán</h1>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Thông tin đơn hàng:</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item) { ?>
                    <tr>
                    <td><img src="img/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 50px;"></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> đ</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h4>Tổng cộng: <?= number_format($total, 0, ',', '.') ?> đ</h4>
        </div>
    </div>

    <form action="process_payment.php" method="POST" class="mt-4">
        <h3 class="mb-3">Thông tin khách hàng:</h3>

        <div class="mb-3">
            <label for="fullname" class="form-label">Họ tên:</label>
            <input type="text" name="fullname" id="fullname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại:</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ giao hàng:</label>
            <textarea name="address" id="address" class="form-control" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Thanh toán</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
