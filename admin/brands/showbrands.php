<?php
 if(isset($_GET['id'])){
    $id=$_GET['id'];
    $products=$conn->query("select*from dssanpham where brandid=$id");
    if(mysqli_num_rows($products)!=0){
        $conn->query("update brands set status=0 where id=$id");
    }else {
        $conn->query("delete from brands where id=$id");
    }
 }
?>
<?php
$query="select*from brands";
$result=$conn->query($query);

?>
<h1> Hang san xuat</h1>
<section style="text-align:center;"> <a class="btn btn-success" href="?option=brandadd">Them hang</a> </section>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Ma hang</th>
            <th>ten hang</th>
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
            <td> <?=$item['status']==1? 'Action' :'Unactive'?></td>
            <td> <a class="btn btn-sm btn-info" href="?option=brandupdate&id=<?=$item['id']?>">Update</a>
            <a class="btn btn-sm btn-danger" href="?option=brand&id=<?=$item['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')">Delete</a> </td>

        </tr>
        <?php endforeach;?>
    </tbody>
</table>