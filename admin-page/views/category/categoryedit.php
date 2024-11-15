<?php
// Kiểm tra xem có id trong URL không
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $CategoryID = $_GET['id'];

    // Lấy thông tin danh mục theo CategoryID
    $sql = 'SELECT * FROM Categories WHERE CategoryID = :CategoryID';
    $stmt = pdo_query_one($sql, ['CategoryID' => $CategoryID]);

    if (!$stmt) {
        echo "Danh mục không tồn tại!";
        exit;
    }
} else {
    echo "Danh mục không tồn tại!";
    exit;
}

?>

<!-- Form sửa danh mục -->
<div class="admin-product-form-container">
    <form action="index.php?act=suadm" method="post" enctype="multipart/form-data">
        <h3>Sửa danh mục (category)</h3>
        <input type="text" name="maloai" value="<?php echo $stmt['CategoryID']; ?>" class="box" disabled />
        <input type="text" name="tenloai" value="<?php echo $stmt['CategoryName']; ?>" class="box" />
        <input type="hidden" name="CategoryID" value="<?php echo $stmt['CategoryID']; ?>" />
        <button type="submit" class="add" name="capnhat" value="CẬP NHẬT">Cập nhật</button>
    </form>
</div>
