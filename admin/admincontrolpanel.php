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
    $chuaxuly=mysqli_num_rows($conn->query("select*from ttkh where status=1"));
    $dangxuly=mysqli_num_rows($conn->query("select*from ttkh where status=2"));
    $daxuly=mysqli_num_rows($conn->query("select*from ttkh where status=3"));
    $huy=mysqli_num_rows($conn->query("select*from ttkh where status=4"));

?>
<table class="table table-bordered tbl-admin">
    <tbody>
        <tr>
            <!-- <td width="18%" height="100">hello:<=$_SESSION['admin']?> <br> [<a href="?option=logout">Logout</a> ]</td> -->
            <td align="center">ADMIN CONTROLPANEL</td>
        </tr>
        <tr>
            <td>
                <section><a href="?option=brand"> >>>>Hang san xuat</a> </section> 
                <section> <a href="?option=product">>>>> San pham</a> </section>
                <section>
                    >>>> DON HANG
                    <section><a href="?option=order&status=1">&nbsp;&nbsp;>> DON HANG CHUA XU LY [<span style="color:red"> <?=$chuaxuly?></span>] </a></section>
                    <section><a href="?option=order&status=2">&nbsp;&nbsp;>> DON HANG DANG XU LY[<span style="color:red"> <?=$dangxuly?></span>] </a></section>
                    <section><a href="?option=order&status=3">&nbsp;&nbsp;>> DON HANG DA XU LY[<span style="color:red"> <?=$daxuly?></span>] </a></section>
                    <section><a href="?option=order&status=4">&nbsp;&nbsp;>> DON HANG  HUY [<span style="color:red"> <?=$huy?></span>]</a></section>
                    
                </section>
            </td>
            <td>
                <?php
                if(isset($_GET['option'])){
                    switch($_GET['option']){
                        // case 'logout':
                        //     unset($_SESSION['admin']);
                        //     header("location: .");
                        //     break;
                        case 'brand':
                            include "brands/showbrands.php";
                            break;
                       case 'brandadd':
                        include "brands/brandadd.php";
                                break;
                        case 'brandupdate':
                            include "brands/brandupdate.php";
                              break;
                         case 'product':
                            include "products/showproducts.php";
                             break;
                        case 'productadd':
                            include "products/productadd.php";
                             break;
                         case 'productupdate':
                             include "products/productupdate.php";
                              break;
                        case 'order':
                          include "orders/showorders.php";
                                 break;
                         case 'orderdetail':
                            include "orders/orderdetail.php";
                                  break;
                    }

                }
                ?>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>