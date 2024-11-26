<?php
session_start();
?>
<?php
// Kết nối cơ sở dữ liệu
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'webcuatoi';

$conn = new mysqli($server, $user, $pass, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    $conn->set_charset("utf8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>
<body>
   <?php
   if (isset($_POST['username'])) {
       $username = $conn->real_escape_string($_POST['username']);
       $password = md5($_POST['password']);

       $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
       $result = $conn->query($query);

       if ($result && $result->num_rows == 0) {
           $alert = "Sai tên đăng nhập hoặc mật khẩu!";
           echo "<script>alert('$alert');</script>";
       } elseif ($result) {
           $user_data = $result->fetch_assoc();
           if ($user_data['status'] == 0) {
               $alert = "Tài khoản đang bị khóa!";
               echo "<script>alert('$alert');</script>";
           } else {
               $_SESSION['admin'] = $username;
               header("Location: index.php");
               exit();
           }
       } else {
           echo "Lỗi truy vấn: " . $conn->error;
       }
   }
   ?>
    <section>
     <?php 
        if (isset($_SESSION['admin'])) {
            include "admincontrolpanel.php";
        } else {
            include "loginadmin.php"; 
        }
     ?>
    </section>
</body>
</html>
