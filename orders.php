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
<?php
if (isset($_SESSION['member'])) {
    $query = "SELECT * FROM account WHERE Name='" . $_SESSION['member'] . "'";
    $member = mysqli_fetch_array($conn->query($query));
} else {
    echo "Người dùng chưa đăng nhập.";
}



if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $note = $_POST['note'];
    $ordermethodid = $_POST['ordermethodid'];
    $memberid = $member['id'];
    
    $query = "INSERT INTO orders (ordermethodid, memberid, name, address, mobile, email, note) 
              VALUES ('$ordermethodid', '$memberid', '$name', '$address', '$mobile', '$email', '$note')";
    
    $conn->query($query);
}

?>



<h1 style="font-size: 2.5em">Đặt hàng</h1>
<form method="post">
    <h2>Thông tin người nhận hàng</h2>
    <section>
        <section>
            <label>Họ tên:</label> 
            <input name="name" value="<?=$member['fullname']?>">
        </section>
        <section>
            <label>Điện thoại:</label> 
            <input type="tel" name="mobile" value="<?=$member['mobile']?>">
        </section>
        <section>
            <label>Địa chỉ:</label> 
            <textarea name="address" rows="3"><?=$member['address']?></textarea>
        </section>
        <section>
            <label>Email:</label> 
            <input type="email" name="email" value="<?=$member['email']?>">
        </section>
        <section>
            <label>Ghi chú:</label> 
            <textarea name="note" rows="3"></textarea>
        </section>
    </section>
   
    <section>
        <input type="submit" value="Đặt hàng" style="margin-top:20px">
    </section>
</form>