<?php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $query = "SELECT * FROM dssanpham WHERE name='$name'";
    if (mysqli_num_rows($conn->query($query)) != 0) {
        $alert = "Đã tồn tại tên sản phẩm này!";
    } else {
        $brandid = $_POST['brandid'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        // Xử lý phần ảnh:
        $store = "../img/";
        $imagename = $_FILES['image']['name'];
        $imagetemp = $_FILES['image']['tmp_name'];

        // Lấy phần mở rộng của file ảnh
        $exp3 = strtolower(substr($imagename, strlen($imagename) - 3));  // 3 ký tự cuối
        $exp4 = strtolower(substr($imagename, strlen($imagename) - 4));  // 4 ký tự cuối

        // Kiểm tra định dạng ảnh hợp lệ
        if (in_array($exp3, ['jpg', 'png', 'bmp', 'gif', 'jpeg', 'webp']) || in_array($exp4, ['jpeg', 'webp'])) {
            // Đổi tên ảnh để tránh trùng lặp
            $imagename = time() . '_' . $imagename;

            // Di chuyển file ảnh vào thư mục lưu trữ
            if (move_uploaded_file($imagetemp, $store . $imagename)) {
                // Thêm thông tin sản phẩm vào cơ sở dữ liệu
                $conn->query("INSERT INTO dssanpham (brandid, name, price, image, description, status)
                              VALUES ('$brandid', '$name', '$price', '$imagename', '$description', '$status')");

                // Chuyển hướng về trang sản phẩm
                header("Location: ?option=dssanpham");
            } else {
                $alert = "Lỗi khi tải ảnh lên!";
            }
        } else {
            $alert = "Lỗi ảnh không hợp lệ!";
        }
    }
}
?>

<?php $brands=$conn->query("select*from brands")?>
<h1>Them san pham</h1>
<section style="color:red;font-weight:bold;text-align:center;"> <?=isset($alert)?$alert:"" ?></section>

<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label> Hang: </label> 
            <select name="brandid" class="form-control" >
                <option hidden>--chon hang--</option>
                <?php
                foreach($brands as $item):
                ?>
                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                <?php endforeach?>
            </select>
        </section>
        <section class="form-group">
            <label> Ten  </label> <input  name="name" class="form-control" required>
        </section>
        <section class="form-group">
            <label> Gia:  </label> <input type="number" min="100000" name="price" class="form-control">
        </section>
        <section class="form-group">
            <label> Anh  </label> <input type="file"  name="image" class="form-control">
        </section>
        <section class="form-group">
            <label> Mô tả: </label> 
            <textarea name="description" id="description"></textarea>
            <script>
                CKEDITOR.replace('description', {
                    enterMode: CKEDITOR.ENTER_BR, // Thay Enter bằng thẻ <br>
                    shiftEnterMode: CKEDITOR.ENTER_P // Shift + Enter để tạo thẻ <p>
                });
            </script>
        </section>
        <section class="form-group">
            <label> Trang thai : </label> <br> <input type="radio" name="status" value="1" checked > Active
            <input type="radio" name="status" value="0" > Unactive
        </section>
        <section> <input type="submit" value="them" class="btn btn-primary">
        <a href="?option=dssanpham" class="btn btn-outline-secondary">&lt;&lt;Back</a>

       </section>
    </form>
</section>