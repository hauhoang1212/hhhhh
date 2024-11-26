<?php
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $query="select*from brands where name='$name'";
    if(mysqli_num_rows($conn->query($query))!=0){
        $alert=" da ton tai ten hang nay!";
    }else{
        $status=$_POST['status'];
        $query="INSERT INTO brands (name,status) VALUES ('$name','$status')";
        $conn->query($query);
        header("location: ?option=brand");
    }
}
?>
<h1>Them hang san xuat</h1>
<section style="color:red;font-weight:bold;text-align:center;"> <?=isset($alert)?$alert:"" ?></section>

<section class="container col-md-6">
    <form method="post">
        <section class="form-group">
            <label> Ten hang </label> <input  name="name" class="form-control">
        </section>
        <section class="form-group">
            <label> Trang thai  hang </label> <br> <input type="radio" name="status" value="1" checked > Active
            <input type="radio" name="status" value="0" > Unactive
        </section>
        <section> <input type="submit" value="them" class="btn btn-primary">
        <a href="?option=brand" class="btn btn-outline-secondary">&lt;&lt;Back</a>

       </section>
    </form>
</section>