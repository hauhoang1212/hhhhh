 <?php
session_start();
?>
<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'webcuatoi';
    
    $conn = new mysqLi($server, $user,  $pass, $database );

    if($conn)
    {
        mysqLi_query($conn, "SET NAMES 'utf8' ");
        echo '';
        echo '<br>';
    }
    else{
        echo'kết nối thất bại';     
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Cửa hàng</title>
    <!--Start of Fchat.vn--><script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=673315cb32a0a945b5187b78" async="async"></script><!--End of Fchat.vn-->
</head> 
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
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
                <li><a>Xin chào, <?=htmlspecialchars($_SESSION['user_name']) ?></a></li>
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
    <section id="image-slider">
            <div class="slider">
                <div class="slide">
                    <img src="img/home/anh.webp" alt="Ảnh 3">
                </div>
                <div class="slide">
                    <img src="img/home/123.webp" alt="Ảnh 1">
                </div>
                <div class="slide">
                    <img src="img/home/111.webp" alt="Ảnh 2">
                </div>
                
            </div>
        </section>
        <section id="page-header">
        <h2>#Sản phẩm bán chạy của chúng tôi</h2>
        <p>Tiết kiệm nhiều hơn với thẻ giảm giá và giảm tới 70%</p>
    </section>
<?php
    $option = 'trangchu';
    $query = "SELECT * FROM dssanpham WHERE status=1";

    if (isset($_GET['brandid'])) {
        $brandid = (int)$_GET['brandid'];  // Ép kiểu số nguyên để bảo mật
        $query .= " AND brandid=" . $brandid;
        $option = 'showproducts&brandid=' . $_GET['brandid'];
    } elseif (isset($_GET['keyword'])) {
        $keyword = $conn->real_escape_string($_GET['keyword']);  // Xử lý chuỗi đầu vào để tránh SQL Injection
        $query .= " AND name LIKE '%" . $keyword . "%'";
        $option = 'showproducts&keyword=' . $_GET['keyword'];
    } elseif (isset($_GET['range'])) {
        $query .= " AND price<=" . $_GET['range'];
        $option = 'showproducts&range=' . $_GET['range'];
    }

    // Lấy số trang hiện tại
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $productsperpage = 10; // Số sản phẩm trên một trang
    $from = ($page - 1) * $productsperpage; // Lấy sản phẩm bắt đầu từ chỉ số nào

    // Đếm tổng số sản phẩm trước khi thêm LIMIT
    $totalQuery = str_replace("SELECT *", "SELECT COUNT(*) as total", $query);
    $totalResult = $conn->query($totalQuery);
    $totalRow = $totalResult->fetch_assoc();
    $totalproducts = $totalRow['total'];

    // Tính tổng số trang
    $totalpages = ceil($totalproducts / $productsperpage);

    // Thêm LIMIT vào truy vấn để lấy các sản phẩm trên trang hiện tại
    $query .= " LIMIT $from, $productsperpage";
    $result = $conn->query($query);
?>

<section id="content">
    <section id="products">
        <?php
        if ($result->num_rows > 0) {
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
        ?>
    </section>

    <!-- Sidebar -->
    <section class="phuc">
        <aside><?php include "left.php"; ?></aside>
    </section>
</section>
<section class="pages">
        <?php for ($i = 1; $i <= $totalpages; $i++): ?>
            <a class="<?= (empty($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i) ? 'highlight' : '' ?>" href="?option=<?= $option ?>&page=<?= $i ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </section>
    <section id="page-header">
    <h2>#Giao hàng tiêu chuẩn miễn phí & Trả hàng miễn phí trong vòng 30 ngày</h2>
    <p>Bứt phá và trải nghiệm đồng hành cùng với bạn trên mọi cuộc đua</p>
    <img width="1500px" src="img/home/bong-ro.webp" alt="" />
</section>
<section>
    <div class="product-section">
    <h2>Nổi bật</h2>
    <div class="product-grid">
        <!-- Card 1 -->
        <div class="product-card">
            <img src="img/home/66.webp" alt="Nike Pegasus 41 GORE-TEX">
            <div class="product-info">
                <p>Chạy trong mưa</p>
                <h3>Nike Pegasus 41 GORE-TEX</h3>
                <button>Cửa hàng</button>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="product-card">
            <img src="img/home/77.webp" alt="LeBron XXII 'Viên ngọc quý'">
            <div class="product-info">
                <p>Mới nhất</p>
                <h3>LeBron XXII 'Viên ngọc quý'</h3>
                <button>Cửa hàng</button>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="product-card">
            <img src="img/home/88.webp" alt="Đường mòn Pegasus dành cho trẻ em 5">
            <div class="product-info">
                <p>Mới nhất</p>
                <h3>Đường mòn Pegasus dành cho trẻ em 5</h3>
                <button>Cửa hàng</button>
            </div>
        </div>
    </div>
</section>
<section id="page-header">
    <h2>#Giao hàng tiêu chuẩn miễn phí & Trả hàng miễn phí trong vòng 30 ngày</h2>
    <p>Bứt phá và trải nghiệm đồng hành cùng với bạn trên mọi cuộc đua</p>
</section>
        <!-- Products Section -->
        <section id="products">
        <?php
        if ($result->num_rows > 0) {
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
        ?>
    </section>
<section class="sports-shopping">
        <h2>Mua sắm theo thể thao</h2>
        <div class="sports-container">
            <div class="sport-item">
                <img src="img/home/123.webp" alt="Chạy">
                <span class="sport-label">Chạy</span>
            </div>
            <div class="sport-item">
                <img src="img/home/bongda.webp" alt="Bóng đá">
                <span class="sport-label">Bóng đá</span>
            </div>
            <div class="sport-item">
                <img src="img/home/mmm.webp" alt="Bóng đá">
                <span class="sport-label">Bóng rổ</span>
            </div>
            <div class="sport-item">
                <img src="img/home/t2.jpg" alt="Bóng đá">
                <span class="sport-label">Tập luyện và tập Gym</span>
            </div>
            <div class="sport-item">
                <img src="img/home/quanvot.jpg" alt="">
                <span class="sport-label">Quần vợt</span>
            </div>
            <div class="sport-item">
                <img src="img/home/patin.png" alt="">
                <span class="sport-label">Trượt ván</span>
            </div>
            <div class="sport-item">
                <img src="img/home/ddadasd.jpeg" alt="">
                <span class="sport-label">Múa</span>
            </div>
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

<style>
    
/* Thêm cho phần cha bao quanh sản phẩm và sidebar */
#content {
    display: flex;
    margin-top: 0px; /* Đảm bảo không bị che khuất bởi header */
    padding: 20px;
    gap: 20px; /* Khoảng cách giữa sản phẩm và sidebar */
}

/* Định dạng cho khu vực sản phẩm */
#products {
    flex: 1; /* Cho phép sản phẩm chiếm không gian còn lại */
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}

/* Định dạng cho khu vực sidebar */
.phuc {
    width: 250px; /* Chiều rộng cố định cho sidebar */
    flex-shrink: 0; /* Ngăn sidebar bị co lại khi không gian không đủ */
}

/* Sidebar (left.php) */
aside {
    position: sticky;
    top: 100px; /* Đảm bảo sidebar dính dưới header */
    width: 250px; /* Kích thước sidebar */
    background-color: #333;
    color: white;
    padding: 20px;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
}

aside a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 10px 0;
    font-size: 16px;
    border-bottom: 1px solid #444;
}

aside a:hover {
    background-color: #575757;
}

/* Định dạng sản phẩm */
.products {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* Mỗi hàng có 5 sản phẩm */
    gap: 20px;
    width: 100%;
}

.product {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 10px;
    transition: all 0.3s ease-in-out;
}

.product:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.product img {
    max-width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
}

.price-container {
    margin-top: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #335;
}
/* page */
.pages {
    display: flex; /* Sử dụng flexbox để sắp xếp các trang */
    justify-content: center; /* Căn giữa các liên kết phân trang */
    margin-top: 20px; /* Khoảng cách trên cho phân trang */
}

.pages a {
    text-decoration: none; /* Không có gạch chân */
    color: #007bff; /* Màu xanh cho liên kết */
    padding: 10px 15px; /* Khoảng cách bên trong cho liên kết */
    border: 1px solid #007bff; /* Đường viền cho liên kết */
    border-radius: 5px; /* Bo góc cho liên kết */
    margin: 0 5px; /* Khoảng cách giữa các liên kết */
    transition: background-color 0.3s, color 0.3s; /* Hiệu ứng chuyển đổi */
}

.pages a:hover {
    background-color: #007bff; /* Màu nền khi hover */
    color: white; /* Màu chữ khi hover */
}

.pages a.highlight {
    background-color: #007bff; /* Màu nền cho trang hiện tại */
    color: white; /* Màu chữ cho trang hiện tại */
    font-weight: bold; /* Làm chữ đậm cho trang hiện tại */
}
#image-slider {
     
            height: 100vh; /* Chiếm toàn bộ chiều cao của viewport */
            overflow: hidden;
            position: relative;
            border-radius: 0; /* Bỏ bo tròn */
        }

        .slider {
            display: flex;
            animation: slide 17s infinite; /* Chuyển động liên tục */
            width: 1300px; /* Để chứa các ảnh lướt qua */
            height: 90%; /* Đảm bảo chiều cao 100% */
        }

        .slide {
            flex: 1 0 100%; /* Căn chỉnh các slide bằng nhau */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            height: 100%; /* Đảm bảo chiều cao 100% */
        }

        .slide img {
            
            width: 100%; /* Chiếm toàn bộ chiều rộng */
            height: 100%; /* Chiếm toàn bộ chiều cao */
            object-fit: cover; /* Đảm bảo ảnh không bị méo */
        }

        @keyframes slide {
            0% { transform: translateX(0); }
            33% { transform: translateX(-100%); }
            66% { transform: translateX(-200%); }
            100% { transform: translateX(0); }
        }
        
/* page-header */
#page-header {
    background-image: url('img/home/img2.png'); /* Đường dẫn đến ảnh nền */
    background-size: cover; /* Ảnh nền phủ kín phần header */
    background-position: center; /* Căn giữa ảnh nền */
    background-repeat: no-repeat;
    padding: 50px 0;
    text-align: center;
    color: #fff; /* Chữ màu trắng cho nổi bật trên ảnh nền */
}

#page-header h2 {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Tạo bóng chữ để dễ đọc hơn trên nền */
}

#page-header p {
    font-size: 18px;
    margin-top: 0;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); /* Bóng chữ nhẹ cho câu mô tả */
}
/* card */  
.product-section {
            padding: 20px;
        }

        .product-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .product-grid {
            display: flex;
            gap: 20px;
            justify-content: space-around;
        }

        .product-card {
            position: relative;
            width: 300px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: left;
        }

        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.7);
        }

        .product-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .product-info h3 {
            margin: 5px 0;
            font-size: 18px;
            font-weight: bold;
        }

        .product-info button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: white;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .product-info button:hover {
            background-color: #f1f1f1;
        }
        .sports-shopping {
    max-width: 1500px;
    margin: 20px auto;
    text-align: center;
}

.sports-shopping h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

.sports-container {
    display: flex;
    gap: 20px;
    justify-content: flex-start;
    overflow-x: auto;  /* Thêm cuộn ngang */
    padding: 10px 0;    /* Thêm khoảng đệm cho không gian xung quanh */
}

.sport-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    width: 500px;
    height: 300px;
    flex-shrink: 0;  /* Không cho các item thu nhỏ khi không gian hẹp */
}

.sport-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: grayscale(100%);
}

.sport-label {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background-color: white;
    color: black;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 18px;
    font-weight: bold;
}

/* Thêm thanh cuộn ngang đẹp mắt */
.sports-container::-webkit-scrollbar {
    height: 8px;
}

.sports-container::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 10px;
}

.sports-container::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}

.sports-container::-webkit-scrollbar-track {
    background-color: #f4f4f4;
}

.carousel-controls {
    margin-top: 20px;
}

.carousel-controls button {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #333;
    margin: 0 10px;
}

.carousel-controls button:hover {
    color: #000;
}

</style>
