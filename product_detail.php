<?php
session_start();
include 'lket.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Lấy ID sản phẩm từ URL và đảm bảo là số nguyên

    $sql = "SELECT name, price, image, description FROM dssanpham WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Sản phẩm không tồn tại.";
        exit;
    }
} else {
    echo "ID sản phẩm không hợp lệ.";
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
    <title>Chi tiết sản phẩm</title>
    <style>
        /* Hiệu ứng Zoom cho hình ảnh */
        .product-image img {
            width: 500px;
            height: 500px;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        .product-image:hover img {
            transform: scale(1.1);
        }

        #product-details {
            margin: 20px;
            display: flex;
            justify-content: center;
        }

        .product-detail-container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            max-width: 800px;
            padding: 20px;
            max-width: 1200px; /* Tăng chiều rộng tối đa của container */
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-info h1 {
            font-size: 24px;
            margin: 10px 0;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .price {
            font-size: 20px;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .description {
            font-size: 16px;
            color: #555;
        }

        .quantity-container {
            margin: 15px 0;
        }

        #add-to-cart, #buy-now, button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        #add-to-cart:hover, #buy-now:hover, button:hover {
            background-color: #218838;
        }

        /* Thêm các sản phẩm liên quan */
        .products {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin: 20px;
    }

    .product {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border: 1px solid #ddd;
        padding: 15px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .product img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .product h2 {
        font-size: 18px;
        margin: 10px 0;
        text-transform: uppercase;
        line-height: 1.2;
    }

    .price-container {
        margin-top: auto;
    }

    .product p {
        font-size: 16px;
        color: #333;
        font-weight: bold;
        white-space: nowrap;
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .product:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    .product-rating {
            margin-top: 20px;
            font-size: 18px;
            color: #f39c12;
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
                <li> <?= htmlspecialchars($_SESSION['user_name']) ?></li>
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

<section id="product-details">
    <div class="product-detail-container">
        <div class="product-image">
            <img src="img/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
        </div>
        <div class="product-info">
            <h1><?php echo htmlspecialchars($row['name']); ?></h1>
            <p class="price">Giá: <?php echo number_format($row['price'], 0, ',', '.') . ' VND'; ?></p>
            <p class="description">Mô tả: <?php echo nl2br(htmlspecialchars($row['description'])); ?></p>

            <!-- Control số lượng -->
            <div class="quantity-container">
                <label for="quantity">Số lượng:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" style="width: 60px;">
            </div>
            <div class="size-container">
                <label for="size">Chọn size:</label>
                <select id="size" name="size">
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                </select>
            </div>

            <!-- Nút thêm vào giỏ hàng -->
            <form id="add-to-cart-form" action="add_to_cart.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
    <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
    <input type="hidden" name="quantity" id="hidden-quantity" value="1">
    <button type="button" id="add-to-cart">Thêm vào giỏ hàng</button>
   
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // kiểm tra user đăng nhập
    function checkLogin(callback) {
        $.ajax({
            url: 'checklogin.php',
            method: 'POST',
            success: function(response) {
                callback(response === 'logged_in');
            }
        });
    }

    // Event listener for "Thêm vào giỏ hàng" button
    document.getElementById('add-to-cart').addEventListener('click', function(event) {
        event.preventDefault();
        checkLogin(function(isLoggedIn) {
            if (isLoggedIn) {
                document.getElementById('add-to-cart-form').submit();
            } else {
                alert('Vui lòng đăng nhập trước khi thêm vào giỏ hàng!');
                window.location.href = 'login.php';
            }
        });
    });

    // Event listener for "Buy" button
    document.getElementById('buy-to-cart').addEventListener('click', function(event) {
        event.preventDefault();
        checkLogin(function(isLoggedIn) {
            if (isLoggedIn) {
                window.location.href = 'checkout.php'; // Redirect to checkout page
            } else {
                alert('Vui lòng đăng nhập trước khi mua hàng!');
                window.location.href = 'login.php';
            }
        });
    });
</script>
            <div class="product-rating">
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star-half-alt"></span>
                <span class="fa fa-star"></span>
            </div>
        </div>
    </div>
</section>

<section class="related-products">
        <h2>Sản phẩm liên quan</h2>
        <section id="products">
        <?php
        include 'lket.php';

        $sql = "SELECT id, name, price, image FROM dssanpham";
        $result = $conn->query($sql);

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
        

        $conn->close();
        ?>
    </section>
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
            <img src="dmca_protected.png" alt="DMCA Protected">
        </div>
</section>

</body>
</html>
