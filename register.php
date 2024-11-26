<?php
//session_start();
include "lket.php";

if (isset($_POST['btn-reg'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {
       
        $checkEmail = "SELECT * FROM account WHERE email = '$email'";
        $result = $conn->query($checkEmail);

        if ($result->num_rows > 0) {
            echo '<script>
                alert("Email này đã được sử dụng. Vui lòng sử dụng email khác.");
                window.location.href = "register.php";
            </script>';
            exit();
        }else {
            $sql = "INSERT INTO account (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
            
            if ($conn->query($sql) === true) {
                echo '
                <script>
                  alert("Đăng Ký Tài Khoản Thành Công. Vui Lòng Đăng Nhập");
                    window.location.href = "login.php";
                </script>';
                exit();
            }else {
                echo "Lỗi: " . $conn->error;
            }
        }
    } else {
        echo 'Bạn cần nhập đầy đủ thông tin';
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
    <title>Register</title>
    <style>
      /* Font */
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
      * {
          font-family: 'Poppins', sans-serif;
          margin: 0;
          padding: 0;
          box-sizing: border-box;
      }
      /* Background and container styling */
      body {
          background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("images/1.jpg");
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center;
          background-attachment: fixed;
          color: #ffffff;
      }
      .box {
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
      }
      .container {
          background: rgba(255, 255, 255, 0.15);
          border-radius: 15px;
          padding: 20px 30px;
          max-width: 400px;
          width: 100%;
          box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
      }
      /* Header and labels */
      .top-header span {
          color: #ffb3b3;
          font-size: small;
          display: flex;
          justify-content: center;
          padding: 10px 0;
      }
      header {
          color: #ffffff;
          font-size: 30px;
          font-weight: 600;
          display: flex;
          justify-content: center;
          padding-bottom: 20px;
      }
      /* Input field styling */
      .input-field {
          position: relative;
          margin-bottom: 20px;
      }
      .input-field .input {
          height: 50px;
          width: 100%;
          padding: 0 15px 0 45px;
          background: rgba(255, 255, 255, 0.2);
          border: 1px solid rgba(255, 255, 255, 0.3);
          border-radius: 30px;
          color: #ffffff;
          outline: none;
          font-size: 1rem;
          transition: background 0.3s ease;
      }
      .input-field .input:focus {
          background: rgba(255, 255, 255, 0.3);
          border-color: #ffffff;
}
      .input-field i {
          position: absolute;
          top: 50%;
          left: 15px;
          transform: translateY(-50%);
          color: #ffffff;
          font-size: 1.2rem;
      }
      ::placeholder {
          color: #d4d4d4;
      }
      /* Button styling */
      .submit {
          height: 50px;
          width: 100%;
          background-color: #ff6b6b;
          border: none;
          border-radius: 30px;
          color: #ffffff;
          font-size: 1rem;
          font-weight: 500;
          cursor: pointer;
          transition: background 0.3s ease, box-shadow 0.3s ease;
      }
      .submit:hover {
          background-color: #e63946;
          box-shadow: 0 4px 10px rgba(255, 107, 107, 0.3);
      }
      /* Checkbox and links */
      .bottom {
          display: flex;
          justify-content: center;
          font-size: small;
          color: #ffffff;
          margin-top: 10px;
      }
      .bottom label a {
          color: #ffb3b3;
          text-decoration: none;
      }
      .bottom label a:hover {
          color: #ff6b6b;
          text-decoration: underline;
      }
      .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        .input-field {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<form action="register.php" method="POST" onsubmit="return checkform()">
        <div class="box">
            <div class="container">
                <div class="top-header">
                    <header>Đăng Kí</header>
                </div>
                <div class="input-field">
                    <input type="text" class="input" placeholder="Username" id="name" name="name">
                    <i class="bx bx-user"></i>
                    <div id="errorname" class="error"></div>
                </div>
                <div class="input-field">
                    <input type="email" class="input" placeholder="Email" id="email" name="email">
                    <i class="bx bx-envelope"></i>
                    <div id="erroremail" class="error"></div>
                </div>
                <div class="input-field">
                    <input type="password" class="input" placeholder="Password" id="password" name="password">
                    <i class="bx bx-lock-alt"></i>
                    <div id="errorpass" class="error"></div>
                </div>
                <div class="input-field">
                    <input type="submit" class="submit" value="Sign Up" name="btn-reg">
                </div>
                <div class="bottom">
                    <label><a href="login.php">Back to login</a></label>
                </div>
            </div>
        </div>
    </form>

    <script>
        function checkform() {
            let isValid = true;
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            document.getElementById("errorname").textContent = "";
            document.getElementById("erroremail").textContent = "";
            document.getElementById("errorpass").textContent = "";
            if (name === "") {
                document.getElementById("errorname").textContent = "Vui lòng điền thông tin đầy đủ.";
                isValid = false;
            }
            if (email === "") {
                document.getElementById("erroremail").textContent = "Vui lòng điền thông tin đầy đủ.";
                isValid = false;
            }
            if (password === "") {
                document.getElementById("errorpass").textContent = "Vui lòng điền thông tin đầy đủ.";
                isValid = false;
            } else {
                const pass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                if (!pass.test(password)) {
                    document.getElementById("errorpass").textContent = "Mật khẩu phải dài ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.";
                    isValid = false;
                }
            }

            return isValid; // Chỉ gửi form nếu tất cả hợp lệ
        }
    </script>
</body>
</html>