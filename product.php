<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy id sản phẩm từ tham số URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn thông tin sản phẩm
$sql = "SELECT * FROM dssanpham WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra và hiển thị thông tin sản phẩm
if ($result->num_rows > 0 && $result->num_rows > 1) {
    $product = $result->fetch_assoc();
} else {
    echo "Không tìm thấy sản phẩm.";
    $product = null; // Đặt biến $product thành null nếu không tìm thấy sản phẩm
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($product) && $product ? $product['ten_san_pham'] : 'Sản phẩm'; ?></title>
</head>
<body>
    <?php if ($product): ?>
        <h1><?php echo htmlspecialchars($product['ten_san_pham']); ?></h1>
        <img src="<?php echo htmlspecialchars($product['hinh_anh']); ?>" alt="<?php echo htmlspecialchars($product['ten_san_pham']); ?>" />
        <p>Giá: <?php echo number_format($product['gia'], 0, ',', '.'); ?> VND</p>
        <p>Mô tả: <?php echo htmlspecialchars($product['mo_ta']); ?></p>
    <?php else: ?>
        <p>Không tìm thấy thông tin sản phẩm.</p>
    <?php endif; ?>
    
    <a href="trangchu.php">Quay lại</a>
</body>
</html>
