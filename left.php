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
    $query="select*from brands where status";
    $result=$conn->query($query);
?>
<?php foreach($result as $item):?>
    <section> <a href="?option=dssanpham&brandid=<?=$item['id']?>"><?=$item['name']?> </a> </section>
<?php endforeach;?>
