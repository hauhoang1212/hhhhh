<!-- php
 $query="select a.fullname, a.mobile,a.address,a.email,b.*,c.number,d.price,d.name.d.image from nguoidung a join orders b on a.id=b.memberid join orderdetail c on b.id=c.orderid join product d on c.productid=d.id where b.id=".$_GET['id'];
 $order=mysqli_fetch_array($conn->query($query));
 $ordermethod=mysqli_fetch_array($conn->query("select*from ordermethod where id=.$order['ordermethodid']))";
 ?>
 <h1>CHI TIET DON HANG<br> (MA DON HANG:<=$order['id']?>)</h1> -->