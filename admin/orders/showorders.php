<?php
//  if(isset($_GET['id'])){
//     $id=$_GET['id'];
//     $products=$conn->query("select*from orderdetail where productid=$id");
//     if(mysqli_num_rows($products)!=0){
//         $conn->query("update product set status=0 where id=$id");
//     }else {
//         $conn->query("delete from product where id=$id");
//         unlink("../images".$_GET['image']);
//     }
//  }
?>
<?php
$status=$_GET['status'];
$query="select*from ttkh where status=$status";
$result=$conn->query($query);

?>
<h1> DON HANG <?=$status==1?'chua xu li' :($status==2?'dang xu li' :($status==3 ?'da xu li': 'huy'))?></h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Ngay tao </th>
       
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1; ?>
       <?php foreach($result as $item): ?>
        <tr>
            <td> <?=$count++?> </td>
            <td><?=$item['id']?></td>
            <td> <?=$item['created_at']?></td>
            <td> <a class="btn btn-sm btn-info" href="?option=orderdetail&id=<?=$item['id']?>">Detail</a>
            <a  style="display:<?=$status==4?'block':'none'?>"class="btn btn-sm btn-danger" href="?option=order&id=<?=$item['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')" >Delete</a> </td>

        </tr>
        <?php endforeach;?>
    </tbody>
</table>