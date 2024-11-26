<?php
session_start();

// Kết nối cơ sở dữ liệu
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'webcuatoi';

$conn = new mysqli($server, $user, $pass, $database);
if ($conn) {
    $conn->set_charset("utf8");
} else {
    die('Kết nối thất bại: ' . $conn->connect_error);
}

// Truy vấn danh sách sản phẩm
$sql = "SELECT * FROM dssanpham ORDER BY RAND()";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Cửa hàng</title>
    <style>
        /* CSS cho phần sản phẩm */
        #products {
            padding: 20px;
            text-align: center;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .product {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: 220px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .product img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .product h2 {
            font-size: 1.1em;
            margin: 10px;
            color: #333;
            font-weight: normal;
        }

        .price-container {
            margin: 10px;
            color: #e67e22;
            font-weight: bold;
        }
    </style>
</head>
<body>
<section id="header">
    <a href="#"><img src="img/home/logo.png" class="logo" alt="Logo"></a>
    <div>
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
    </div>
</section>
<section id="page-header">
    <img width="1500px" src="img/home/slider_3.webp" alt="" />
    <h2>#Giao hàng tiêu chuẩn miễn phí & Trả hàng miễn phí trong vòng 30 ngày</h2>
    <p>Bứt phá và trải nghiệm đồng hành cùng với bạn trên mọi cuộc đua</p>
</section>
<section id="products">
    <?php
    if ($result && $result->num_rows > 0) {
        echo '<div class="products">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo "<a href='product_detail.php?id=" . $row['id'] . "' style='text-decoration: none; color: inherit;'>";
            echo "<img src='img/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
            echo '<h2>' . htmlspecialchars($row['name']) . '</h2>';
            echo '</a>';
            echo '<div class="price-container">';
            echo '<p>Giá: ' . number_format($row['price'], 0, ',', '.') . ' VND</p>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "<p>Không có sản phẩm nào.</p>";
    }
    $conn->close();
    ?>
</section>
<section class="footer">
    <div class="footer-content">
            <!-- Logo và thông tin cửa hàng -->
        <div class="footer-column">
            <img src="img/home/logo.png" alt="Authentic Shoes" class="logo">
            <p>Hộ Kinh Doanh Nghiêm Xuân Huy MST : 01E8027929</p>
            <p>Authentic Shoes - Nhà sưu tầm và phân phối chính hãng các thương hiệu thời trang quốc tế hàng đầu Việt Nam</p>
            <h3>HỆ THỐNG CỬA HÀNG</h3>
            <p>
                <i class="fas fa-map-marker-alt"></i> Cơ sở 1: 561 Nguyễn Đình Chiểu Phường 2 <br>
                <i class="fas fa-phone-alt"></i> Hotline : 0786665444<br>
                <i class="fas fa-map-marker-alt"></i> Cơ sở 2: 70-72 Tây Sơn - Đống Đa - Hà Nội<br>
                <i class="fas fa-phone-alt"></i> Hotline : 0785499555<br>
                <i class="fas fa-envelope"></i> Service@AutheticShoes.com<br>
            </p>
                <p>ĐKKD: 01E8027929 - Cấp ngày: 01/06/2019 - Nơi cấp: Hà Nội</p>
            </div>

            <!-- Về chúng tôi -->
            <div class="footer-column">
                <h3>Về chúng tôi</h3>
                <p>Giới Thiệu</p>
                <p>Tuyển Dụng</p>
                <p>Dịch Vụ Spa, Sửa Giày</p>
                <p>Tin Tức - Sự Kiện</p>
                <h3>Kết nối với chúng tôi</h3>
                <div class="social-icons">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-tiktok"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>

            <!-- Hỗ trợ khách hàng -->
            <div class="footer-column">
                <h3>Hỗ trợ khách hàng</h3>
                <p>Hướng dẫn mua hàng</p>
                <p>Chính sách đổi trả và bảo hành</p>
                <p>Chính Sách Thanh Toán</p>
                <p>Điều khoản trang web</p>
                <p>Chính sách bảo vệ thông tin cá nhân của người tiêu dùng</p>
                <p>Vận chuyển và giao hàng</p>
            </div>
        </div>

        <!-- Dấu bảo vệ DMCA -->
        <div class="footer-dmca">
            <img src="img/home/logo.png" alt="DMCA Protected">
        </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Cửa hàng của chúng tôi - All rights reserved.</p>
    </footer>
</body>
</html>
