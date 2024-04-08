<link rel="stylesheet" type="text/css" href="css/admin_style.css" >
<script src="resources/ckeditor/ckeditor.js"></script>
<style>
    .danhmuc{
    min-width: 200px;
    height: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
    }
</style>
<?php
include 'connect_db.php';
include 'function.php';

    ?>
    <div class="main-content">
        <div id="content-box">
            <?php
            $sql = "SELECT * FROM `menu_product`";
            $menu = mysqli_query($con,$sql);
            $menu_pro = mysqli_fetch_all($menu,MYSQLI_ASSOC);
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
                if (isset($_POST['name']) && !empty($_POST['name']) ) {
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên danh mục";
                    } 
                    if (!isset($error)) {
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Cập nhật lại sản phẩm
                            $result = mysqli_query($con, "UPDATE `menu_product` SET `id` = '" . $_POST['id'] . "',`name` = '" . $_POST['name'] . "' WHERE `menu_product`.`id` = " . $_GET['id']);
                        } else { //Thêm sản phẩm
                            $result = mysqli_query($con, "INSERT INTO `menu_product` (`id`, `name`) VALUES (NULL, '" . $_POST['name'] . "');");
                        }
                        if (!$result) { //Nếu có lỗi xảy ra
                            $error = "Danh mục đã tồn tại";
                        } 
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin danh mục.";
                }
                ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Thêm danh mục thành công" ?></div>
                    <a href = "menu_product.php">Quay lại danh sách danh mục</a>
                </div>
                <?php
            } 
                ?>
                <form id="product-form" method="POST" action="<?= (!empty($product) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên danh mục: </label>
                        <input type="text" name="name" value="<?= (!empty($product) ? $product['name'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                </form>
                <div class="clear-both"></div>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
        </div>
    </div>

    <?php
?>
