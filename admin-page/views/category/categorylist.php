table
          <div class="table--wrapper">
            <h3 class="title">Danh mục sản phẩm (category)</h3>
            <a href="?act=addcategory"><button class="add">Thêm danh mục</button></a>
            <div class="table-container">
                <table style="text-align: left;">
                <table>
                    <tr>
                        <th></th>
                        <th>MÃ LOẠI</th>
                        <th>TÊN LOẠI</th>
                        <th></th>
                    </tr>
                    <?php 
                         $listCategori = loadall_category();  // Gọi hàm loadall_category() để lấy danh sách danh mục từ cơ sở dữ liệu
                         if (!empty($listCategori)) {
                             foreach ($listCategori as $categori) {
                                 extract($categori);  // Lấy các phần tử của mảng $categori thành các biến riêng biệt
                                 echo '
                                     <tr>
                                         <td><input type="checkbox" name="" id=""></td>
                                         <td>'.$CategoryID.'</td>  
                                         <td>'.$CategoryName.'</td>
                                         <td>
                                             <a href="index.php?act=editcategory&id='.$CategoryID.'"><input type="button" value="sửa"></a>
                                            <a href="index.php?act=xoadm&id='.$CategoryID.'" 
                     onclick="return confirm(\'Bạn có chắc chắn muốn xóa danh mục này?\');">
                     <input type="button" value="Xóa">
                                         </td>
                                     </tr>
                                 ';
                             }
                         } else {
                             echo "<tr><td colspan='4'>Không có danh mục nào</td></tr>";  // Nếu không có danh mục, hiển thị thông báo
                         }
                    ?>
                </table>
            </div>
          </div>
        <!-- footer -->
        <footer class="footer">
            <div class="footer-content">
                <p>© 2024 Admin Unique Style. All Rights Reserved.</p>
            </div>
        </footer>