<?php
class SizeModel {
    public $conn;

    // Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả kích cỡ của sản phẩm
    public function getAllSizes() {
        $query = "SELECT sizes.SizeID, sizes.Size, sizes.StockQuantity, products.ProductName 
                  FROM sizes 
                  INNER JOIN products ON sizes.ProductID = products.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy thông tin kích cỡ theo ID
  public function getSizeById($sizeID)
  {
      $query = "SELECT sizes.SizeID, sizes.Size, sizes.StockQuantity, sizes.ProductID, products.ProductName
                FROM sizes
                JOIN products ON sizes.ProductID = products.id  -- Sử dụng 'id' thay vì 'ProductID' trong bảng products
                WHERE sizes.SizeID = :sizeID";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':sizeID', $sizeID, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }  
  // Trong Model

  public function getProductById($productID)
  {
      $sql = "SELECT * FROM products WHERE id = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$productID]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }

    // Cập nhật kích cỡ
 // SizeModel.php
 public function updateSize($sizeID, $productID, $size, $stockQuantity)
 {
     // Cập nhật thông tin kích cỡ trong bảng sizes
     $query = "UPDATE sizes 
               SET ProductID = :productID, Size = :size, StockQuantity = :stockQuantity
               WHERE SizeID = :sizeID";
     
     // Chuẩn bị câu lệnh SQL
     $stmt = $this->conn->prepare($query);
 
     // Gắn giá trị vào các tham số
     $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
     $stmt->bindParam(':size', $size, PDO::PARAM_STR);
     $stmt->bindParam(':stockQuantity', $stockQuantity, PDO::PARAM_INT);
     $stmt->bindParam(':sizeID', $sizeID, PDO::PARAM_INT);
 
     // Thực thi câu lệnh
     return $stmt->execute();  // Trả về true nếu câu lệnh thực thi thành công
 }
 
    public function addSize($productID, $size, $stockQuantity)
{
    $query = "INSERT INTO sizes (ProductID, Size, StockQuantity) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$productID, $size, $stockQuantity]);
}
    // Xóa kích cỡ
    public function deleteSize($sizeID)
{
    $query = "DELETE FROM sizes WHERE SizeID = :sizeID";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':sizeID', $sizeID, PDO::PARAM_INT);

    // Kiểm tra kết quả thực thi và trả về true/false
    return $stmt->execute();
}

// SizeModel.php


}
?>