        <div class="admin-product-form-container">
        <form action="index.php?act=categoryadd" method="post" enctype="multipart/form-data">
                <h3>Thêm danh mục (category)</h3>
                <input type="text" placeholder="Nhập mã danh mục....." name="maloai" class="box"/>
                <input type="text" placeholder="Nhập tên danh mục....." name="tenloai" class="box"/>
                <button type="" class="add">Nhập lại</button>
                <button type="button" class="add" onclick="window.location.href='index.php?act=listcategory'">Danh sách</button>
                <button type="submit" class="add"  name="submit" value="THÊM MỚI">Thêm danh mục</button>
                <?php
      if (isset($thongBao) && ($thongBao != '')) {
        echo $thongBao;
      }
      ?>
            </form>
        </div>