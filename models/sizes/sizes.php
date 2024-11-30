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
        $query = "SELECT sizes.SizeID, sizes.Size, sizes.StockQuantity, sizes.Price, products.ProductName 
                  FROM sizes 
                  INNER JOIN products ON sizes.ProductID = products.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
    // Lấy thông tin kích cỡ theo ID
    public function getSizeById($sizeID) {
        $query = "SELECT * FROM sizes WHERE SizeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$sizeID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
  // Trong Model

  public function getProductById($productID) {
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$productID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // Cập nhật kích cỡ
    public function updateSize($sizeID, $productID, $size, $stockQuantity, $price) {
        $query = "UPDATE sizes SET ProductID = ?, Size = ?, StockQuantity = ?, Price = ? WHERE SizeID = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$productID, $size, $stockQuantity, $price, $sizeID]);
    }

 
 public function addSize($productID, $size, $stockQuantity, $price)
 {
     $query = "INSERT INTO sizes (ProductID, Size, StockQuantity, Price) VALUES (?, ?, ?, ?)";
     $stmt = $this->conn->prepare($query);
     return $stmt->execute([$productID, $size, $stockQuantity, $price]);
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

public function getPriceBySize($productID, $size)
{
    $query = "SELECT Price 
              FROM sizes 
              WHERE ProductID = :productID AND Size = :size";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
    $stmt->bindParam(':size', $size, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['Price']; // Trả về giá
}
}
?>