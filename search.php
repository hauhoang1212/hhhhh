<?php
include "lket.php"; 

// Lấy truy vấn từ biểu mẫu
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Kiểm tra xem truy vấn có hợp lệ không
if ($query !== '') {
    // Truy vấn cơ sở dữ liệu
    $sql = "SELECT * FROM dssanpham WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    $likeQuery = "%$query%";
    $stmt->bind_param("s", $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kết quả tìm kiếm</title>
        <link rel="stylesheet" href="style.css"> <!-- Đường dẫn tới file CSS -->
        <style>
            /* Định dạng phần chứa sản phẩm */
            #products {
                padding: 20px;
                text-align: center;
            }

            /* Bố cục sản phẩm dạng lưới */
            .products {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: center;
            }

            /* Định dạng cho mỗi sản phẩm */
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

            /* Hình ảnh sản phẩm */
            .product img {
                width: 100%;
                height: auto;
                border-bottom: 1px solid #ddd;
            }

            /* Tiêu đề sản phẩm */
            .product h2 {
                font-size: 1.1em;
                margin: 10px;
                color: #333;
                font-weight: normal;
            }

            /* Định dạng giá sản phẩm */
            .price-container {
                margin: 10px;
                color: #e67e22;
                font-weight: bold;
            }

            /* Thông báo khi không có sản phẩm */
            #products p {
                color: #e74c3c;
                font-size: 1.2em;
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

        <h1>Kết quả tìm kiếm cho: <?php echo htmlspecialchars($query); ?></h1>

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

            $stmt->close();
        } else {
            echo "<p>Vui lòng nhập từ khóa tìm kiếm.</p>";
        }

        $conn->close();
        ?>
        </section>
        
    </body>
    </html>
