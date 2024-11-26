<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa có
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Xử lý yêu cầu xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['remove']) && isset($_SESSION['cart'][$_GET['remove']])) {
    $idToRemove = $_GET['remove'];
    unset($_SESSION['cart'][$idToRemove]);
    header("Location: cart.php"); // Chuyển hướng lại trang giỏ hàng
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Giỏ hàng</title>
</head>
<body>
<section id="header">
    <a href="#"><img src="img/home/logo.png" class="logo" alt="Logo"></a>
    <div>
    <?php

?>

<ul id="navbar">
    <li><a href="trangchu.php">Trang chủ</a></li>
    <li><a class="active" href="shop.php">Cửa hàng</a></li>
    <li><a href="blog.html">Blogs</a></li>

    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Người dùng đã đăng nhập -->
        <li class="dropdown">
            <a href="logout.php">Đăng xuất</a>
            <ul class="dropdown-menu">
                <li><a>Xin chào, <?= htmlspecialchars($_SESSION['user_name']) ?></a></li>
            </ul>
        </li>
    <?php else: ?>
        <!-- Người dùng chưa đăng nhập -->
        <li><a href="register.php">Đăng ký</a></li>
        <li><a href="login.php">Đăng nhập</a></li>
    <?php endif; ?>

    <li>
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="Tìm kiếm..." />
            <button type="submit">Tìm SP</button>
        </form>
    </li>
    <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a></li>
</ul>
<style>
 
</style>

    </div>
</section>

<section id="cart">
    <h1>Giỏ hàng của bạn</h1>
    <?php if (empty($cart)): ?>
        <p>Giỏ hàng trống.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $id => $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($id); ?></td> <!-- Đây là ID của sản phẩm -->
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><img src="img/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 50px;"></td>
                        <td>
                            <form action="update_cart.php" method="post" style="display:inline;" id="form_<?php echo $id; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width: 50px;" id="quantity_<?php echo $id; ?>" onchange="updateCart(<?php echo $id; ?>)">
                            </form>
                        </td>
                        <td><?php echo number_format($item['price'], 0, ',', '.') . ' VND'; ?></td>
                        <td><?php echo number_format($item['quantity'] * $item['price'], 0, ',', '.') . ' VND'; ?></td>
                        <td>
                            <a href="cart.php?remove=<?php echo $id; ?>" class="remove-btn">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">
            <h2>Tổng tiền: 
                <?php 
                $total = 0;
                foreach ($cart as $item) {
                    $total += $item['quantity'] * $item['price'];
                }
                echo number_format($total, 0, ',', '.') . ' VND'; 
                ?>
            </h2>
        </div>

        <!-- Nút thanh toán -->
        <form action="payment.php" method="post">
            <?php foreach ($cart as $id => $item): ?>
                <input type="hidden" name="cart[<?php echo $id; ?>][name]" value="<?php echo htmlspecialchars($item['name']); ?>">
                <input type="hidden" name="cart[<?php echo $id; ?>][price]" value="<?php echo $item['price']; ?>">
                <input type="hidden" name="cart[<?php echo $id; ?>][image]" value="<?php echo htmlspecialchars($item['image']); ?>">
                <input type="hidden" name="cart[<?php echo $id; ?>][quantity]" value="<?php echo $item['quantity']; ?>">
            <?php endforeach; ?>
            <button type="submit">Thanh toán</button>
        </form>
    <?php endif; ?>
</section>
<script>
    function updateCart(id) {
        // Tìm form tương ứng với sản phẩm
        var form = document.getElementById('form_' + id);
        
        // Tạo sự kiện gửi form
        form.submit();
    }
</script>

<style>
    #cart {
        margin: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        overflow: hidden; /* Ngăn chặn nội dung tràn ra ngoài */
        text-overflow: ellipsis; /* Thêm dấu "..." khi tràn */
        white-space: nowrap; /* Ngăn chặn ngắt dòng */
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        border-radius: 5px;
    }

    .total {
        font-size: 24px;
        font-weight: bold;
        color: #e74c3c;
    }

    button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }

    .remove-btn {
        color: #e74c3c;
        text-decoration: none;
        font-weight: bold;
    }

    .remove-btn:hover {
        color: #c0392b;
    }
</style>
</body>
</html>
