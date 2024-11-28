<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "webcuatoi";

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Nhận nội dung từ yêu cầu (phần chat)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query']; // Lấy nội dung chat từ người dùng
    
    // Tìm kiếm sản phẩm có tên hoặc mô tả gần giống
    $stmt = $conn->prepare("
        SELECT name, description, price 
        FROM dssanpham 
        WHERE name LIKE ? OR description LIKE ?
        LIMIT 5
    ");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $products = [];
    
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    // Trả kết quả dạng JSON
    if (count($products) > 0) {
        echo json_encode([
            "status" => "success",
            "data" => $products
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Không tìm thấy sản phẩm phù hợp."
        ]);
    }
    
    $stmt->close();
}
$conn->close();
?>
