<?php
$product = mysqli_fetch_array($conn->query("SELECT * FROM dssanpham WHERE id=" . $_GET['id']));

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $query = "SELECT * FROM dssanpham WHERE name='$name' AND id != " . $product['id'];
    if (mysqli_num_rows($conn->query($query)) != 0) {
        $alert = "Đã có sản phẩm khác có tên này!";
    } else {
        $brandid = $_POST['brandid'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        // Xử lý phần ảnh:
        $store = "../img/";
        $imagename = $_FILES['image']['name'];
        $imagetemp = $_FILES['image']['tmp_name'];

        // Kiểm tra nếu có ảnh mới
        if (!empty($imagename)) {
            // Kiểm tra phần mở rộng của file ảnh
            $fileInfo = pathinfo($imagename);
            $ext = strtolower($fileInfo['extension']); // Lấy phần mở rộng của file

            // Kiểm tra định dạng ảnh hợp lệ
            if (in_array($ext, ['jpg', 'png', 'bmp', 'gif', 'jpeg', 'webp'])) {
                // Đổi tên ảnh để tránh trùng lặp
                $imagename = time() . '_' . $imagename;

                // Di chuyển file ảnh vào thư mục lưu trữ
                if (move_uploaded_file($imagetemp, $store . $imagename)) {
                    // Xóa ảnh cũ nếu có ảnh mới
                    unlink($store . $product['image']);
                } else {
                    $alert = "Lỗi khi tải ảnh lên!";
                }
            } else {
                $alert = "Lỗi ảnh không hợp lệ!";
            }
        } else {
            // Nếu không có ảnh mới, giữ ảnh cũ
            $imagename = $product['image'];
        }

        // Cập nhật thông tin sản phẩm vào cơ sở dữ liệu
        $conn->query("UPDATE dssanpham SET brandid='$brandid', name='$name', price='$price', image='$imagename', description='$description', status='$status' WHERE id=" . $product['id']);

        // Chuyển hướng về trang sản phẩm
        header("Location: ?option=dssanpham");
        exit; // Đảm bảo không có mã nào được thực thi sau khi chuyển hướng
    }
}
?>

<?php $brands = $conn->query("SELECT * FROM brands"); ?>
<h1>Cập nhật sản phẩm</h1>
<section style="color:red;font-weight:bold;text-align:center;"> <?= isset($alert) ? $alert : "" ?> </section>

<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label> Hãng: </label>
            <select name="brandid" class="form-control">
                <option hidden>-- Chọn hãng --</option>
                <?php
                foreach ($brands as $item) :
                ?>
                    <option value="<?= $item['id'] ?>" <?= $item['id'] == $product['brandid'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                <?php endforeach ?>
            </select>
        </section>
        <section class="form-group">
            <label> Tên: </label>
            <input name="name" class="form-control" required value="<?= $product['name'] ?>">
        </section>
        <section class="form-group">
            <label> Giá: </label>
            <input type="number" min="100000" name="price" class="form-control" value="<?= $product['price'] ?>">
        </section>
        <section class="form-group">
            <label> Ảnh: </label> <br>
            <img src="../img/<?= $product['image'] ?>" width="70%">
            <input type="file" name="image" class="form-control">
        </section>
        <section class="form-group">
            <label> Mô tả: </label>
            <textarea name="description" id="description"><?= $product['description'] ?></textarea>
            <script>
                CKEDITOR.replace('description');
            </script>
        </section>
        <section class="form-group">
            <label> Trạng thái: </label> <br>
            <input type="radio" name="status" value="1" <?= $product['status'] == 1 ? 'checked' : '' ?>> Active
            <input type="radio" name="status" value="0" <?= $product['status'] == 0 ? 'checked' : '' ?>> Unactive
        </section>
        <section>
            <input type="submit" value="Cập nhật" class="btn btn-primary">
            <a href="?option=product" class="btn btn-outline-secondary">&lt;&lt; Quay lại</a>
        </section>
    </form>
</section>
