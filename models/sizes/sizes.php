<?php
class SizeModel
{
    public $conn;

    // Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllProducts()
    {
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả kích cỡ của sản phẩm
    public function getAllSizes($page = 1)
    {
        try {
            $itemsPerPage = 8; // Số lượng sản phẩm mỗi trang
            $offset = ($page - 1) * $itemsPerPage; // Tính vị trí bắt đầu

            // Truy vấn để lấy tất cả các kích thước
            $query = "SELECT sizes.SizeID, sizes.Size, sizes.StockQuantity, 
                         products.ProductName, products.id AS ProductID, products.status 
                  FROM sizes 
                  INNER JOIN products ON sizes.ProductID = products.id
                  LIMIT :limit OFFSET :offset";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Kiểm tra và cập nhật status nếu cần
            foreach ($sizes as $size) {
                if ($size['StockQuantity'] == 0 && $size['status'] != 0) { // Chỉ cập nhật khi status khác 0
                    $updateQuery = "UPDATE products 
                                SET status = 0 
                                WHERE id = :productID";
                    $updateStmt = $this->conn->prepare($updateQuery);
                    $updateStmt->bindParam(':productID', $size['ProductID'], PDO::PARAM_INT);
                    $updateStmt->execute();
                }
            }

            return $sizes;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    public function getTotalPages()
    {
        try {
            $itemsPerPage = 8; // Số sản phẩm mỗi trang

            // Đếm tổng số sản phẩm
            $query = "SELECT COUNT(*) as total FROM sizes";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalItems = $result['total'];

            // Tính tổng số trang
            return ceil($totalItems / $itemsPerPage);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return 0;
        }
    }

    // Lấy thông tin kích cỡ theo ID
    public function getSizeById($sizeID)
    {
        $query = "SELECT 
                sizes.SizeID, 
                sizes.Size, 
                sizes.StockQuantity, 
                sizes.ProductID, 
                products.ProductName, 
                products.Price -- Thêm cột Price để hiển thị giá
              FROM sizes
              JOIN products ON sizes.ProductID = products.id 
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
        // Kiểm tra giá trị hợp lệ
        if (empty($stockQuantity) || !is_numeric($stockQuantity) || $stockQuantity <= 0) {
            throw new InvalidArgumentException("Số lượng tồn kho không hợp lệ.");
        }

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

    public function getStockQuantity($ProductID, $SizeID)
    {
        try {
            $sql = "SELECT StockQuantity 
                    FROM sizes 
                    WHERE ProductID = :ProductID AND SizeID = :SizeID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ProductID', $ProductID, PDO::PARAM_INT);
            $stmt->bindParam(':SizeID', $SizeID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function updateStockQuantity($ProductID, $SizeID, $new)
    {
        try {
            $sql = "UPDATE sizes 
                SET StockQuantity = :StockQuantity 
                WHERE ProductID = :ProductID AND SizeID = :SizeID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':StockQuantity', $new, PDO::PARAM_INT);
            $stmt->bindParam(':ProductID', $ProductID, PDO::PARAM_INT);
            $stmt->bindParam(':SizeID', $SizeID, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
}
