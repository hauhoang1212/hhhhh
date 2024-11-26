
<?php
session_start();
include 'lket.php'; // Kết nối tới cơ sở dữ liệu

if (isset($_POST['btn-log'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Truy vấn cơ sở dữ liệu để kiểm tra thông tin đăng nhập từ bảng account
    $query = "SELECT * FROM account WHERE Email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Kiểm tra mật khẩu 
        if ($password === $user['Password']) {
            // Lưu thông tin vào session
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['user_name'] = $user['Name'];
            $_SESSION['level'] = $user['Level'];

            // Chuyển hướng người dùng dựa trên level
            if ($user['Level'] == 1) {
                header("Location: trangchu.php"); // Trang admin
            } elseif ($user['Level'] == 0) {
                header("Location: trangchu.php"); // Trang người dùng thường
            }
            exit();
        } else {
            echo "<script>alert('Sai mật khẩu!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Tài khoản không tồn tại!'); window.location.href='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    
      
   </style>
</head>
<body>
    <form action="login.php" method="POST">
        <div class="box">
            <div class="container">
                <div class="top-header">
                    <header>Login</header>
                </div>
                <div class="input-field">
                    <input type="text" class="input" placeholder="Username"id="email" name="email" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-field">
                     <input type="password" class="input" placeholder="Password" id="password" name="password" required> 
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-field">
                    <input type="submit" class="submit" value="Login" name="btn-log">
                </div>
            </div>
        </div>
    </form>
</body>
</html>