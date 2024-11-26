<?php
    include "lket.php"; // Kết nối tới CSDL

    // Câu lệnh SQL để tạo bảng
    $sql = "CREATE TABLE IF NOT EXISTS chitietdh (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT,
            product_id INT,
            quantity INT,
            price INT,
            FOREIGN KEY (order_id) REFERENCES ttkh(id),
            FOREIGN KEY (product_id) REFERENCES dssanpham(id)
    )";

    // Thực thi câu lệnh SQL
    if ($conn->query($sql) === TRUE) {
        echo "Tạo bảng  thành công!";
    } else {
        echo "Lỗi khi tạo bảng: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();

?>
