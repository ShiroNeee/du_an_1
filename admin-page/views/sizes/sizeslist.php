<!-- sizeslist.php -->
<div class="table--wrapper">
    <h3 class="title"></h3>
    <a href="?act=sizes-add"><button class="add">Thêm kích cỡ mới</button></a>
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"
            style="background-color:#d4edda;border:0.5px solid #ddd;border-radius:6px;color:#155724;border-color: #c3e6cb; margin-bottom:5px;font-family: Arial, sans-serif;">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <div class="table-container">
        <table style="text-align: left;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Kích cỡ</th>
                    <th>Số lượng trong kho</th>
                    <th>Giá (VND)</th>
                    <th>Chỉnh sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sizes = $this->modelSizes->getAllSizes(); // Lấy dữ liệu kích cỡ từ model
                if ($sizes) {
                    foreach ($sizes as $size) {
                        echo "<tr>";
                        echo "<td style='font-size:20px'>" . $size['SizeID'] . "</td>";
                        echo "<td style='font-size:15px'>" . $size['ProductName'] . "</td>";
                        echo "<td>" . $size['Size'] . "</td>";
                        echo "<td>" . $size['StockQuantity'] . "</td>";
                        echo "<td>" . number_format($size['Price'], 0, ',', '.') . " VND</td>"; // Định dạng giá tiền
                        echo "<td>
                    <a href='?act=sizes-edit&id=" . $size['SizeID'] . "'>
                        <button class='edit'>Sửa</button>
                    </a>
                  </td>";
                        echo "<td>
                    <a href='?act=sizes-delete&id=" . $size['SizeID'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa kích cỡ này không?\")'>
                        <button class='delete'>Xóa</button>
                    </a>
                  </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>Không có dữ liệu kích cỡ.</td></tr>";
                }
                ?>
            </tbody>

        </table>
    </div>
</div>