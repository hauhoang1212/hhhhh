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
 if(isset($_GET['id'])){
    $id=$_GET['id'];
    $products=$conn->query("select*from ttkh where created_at=$id");
    if(mysqli_num_rows($products)!=0){
        $conn->query("update dssanpham set status=0 where id=$id");
    }else {
        $conn->query("delete from dssanpham where id=$id");
        unlink("../img/".$_GET['image']);
    }
 }
?>
<?php
$query="select*from dssanpham";
$result=$conn->query($query);

?>
<h1> DANH SACH SAN PHAM</h1>
<section style="text-align:center;"> <a class="btn btn-success" href="?option=productadd">Them san pham</a> </section>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Ten </th>
            <th>Gia</th>
            <th>Anh</th>
            <th>Trang thai</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1; ?>
       <?php foreach($result as $item): ?>
        <tr>
            <td> <?=$count++?> </td>
            <td><?=$item['id']?></td>
            <td> <?=$item['name']?></td>
            <td> <?=number_format($item['price'],0,',','.')?></td>
            <td width="30%"> <img src="../img/<?=$item['image']?>"width="20%"></td>

            <td> <?=$item['status']==1? 'Action' :'Unactive'?></td>
            <td> <a class="btn btn-sm btn-info" href="?option=productupdate&id=<?=$item['id']?>">Update</a>
            <a class="btn btn-sm btn-danger" href="?option=product&id=<?=$item['id']?>&image=<?=$item['image']?>" class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')">Delete</a> </td>

        </tr>
        <?php endforeach;?>
    </tbody>
</table>