<?php
class Product
{
    public $conn;

    // Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }
    // Lấy ra toàn bộ sản phẩm
    public function getAllProduct()
    {
        try {
            $sql = "SELECT u.*, r.statusName, 
                    c.CategoryName 
        FROM products u
        LEFT JOIN status r ON u.status = r.statusID
        LEFT JOIN categories c ON u.CategoryID = c.CategoryID";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    // Thêm sản phẩm 
    public function postData($ProductName, $Description, $Price, $CategoryID, $status, $image)
    {
        try {
            $sql = "INSERT INTO products (ProductName, Description, Price, CategoryID, status, image) VALUES (:ProductName, :Description, :Price, :CategoryID, :status, :image)";
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':ProductName', $ProductName);
            $stmt->bindParam(':Description', $Description);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':CategoryID', $CategoryID);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':image', $image);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // Lấy thông tin chi tiết sản phẩm
    public function getDetail($id)
    {
        try {
            $sql = "SELECT u.*, r.statusName, 
                    c.CategoryName 
            FROM products u
            LEFT JOIN status r ON u.status = r.statusID
            LEFT JOIN categories c ON u.CategoryID = c.CategoryID
            WHERE u.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    
    // Model SizeModel

    public function getStatusList()
    {
        try {
            $sql = "SELECT * FROM status";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function getCategoryList()
    {
        try {
            $sql = "SELECT * FROM categories";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    
    // Xoá sản phẩm
    public function deleteData($id)
    {
        try {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }


    public function showProductHome($limit = 10)
    {
        try {
            // Câu lệnh SQL lấy sản phẩm còn hàng (Status = 1), sắp xếp theo id giảm dần và giới hạn số lượng sản phẩm
            $sql = "SELECT * FROM products WHERE Status = 1 ORDER BY id DESC LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    public function getProductsByCategoryId($categoryId)
    {
        $query = "SELECT * FROM products WHERE CategoryID = :categoryId AND status = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($productId) {
        $query = "SELECT * FROM products WHERE id = :productId AND status = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Hủy kết nối
    public function __destruct()
    {
        $this->conn = null;
    }
    // add data
    public function addData($ProductName, $Description, $Price, $CategoryID, $status, $image)
    {
        try {
            $sql = "INSERT INTO products 
                    (ProductName, Description, Price, CategoryID, status, image)
                    VALUES (:ProductName, :Description, :Price, :CategoryID, :status, :image) ";
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':ProductName', $ProductName);
            $stmt->bindParam(':Description', $Description);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':CategoryID', $CategoryID);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':image', $image);

            // Thực thi câu truy vấn
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // update data
    public function updateDataProduct($id, $ProductName, $Description, $Price, $CategoryID, $status, $image)
    {
        try {
            $sql = "UPDATE products SET 
                    ProductName = :ProductName,
                    Description = :Description,
                    Price       = :Price,
                    CategoryID  = :CategoryID,
                    status      = :status,
                    image       = :image
                WHERE id        = :id";
            $stmt = $this->conn->prepare($sql);
            // Gán giá trị cho các tham số
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':ProductName', $ProductName);
            $stmt->bindParam(':Description', $Description);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':CategoryID', $CategoryID);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':image', $image);
            // Thực thi câu truy vấn
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // Lấy thông tin sản phẩm theo ID
public function getProductSizes($productID) {
    $query = "
        SELECT s.Size, s.StockQuantity
        FROM sizes s
        WHERE s.ProductID = :productID
    ";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
    $stmt->execute();

    // Trả về danh sách kích cỡ và số tồn kho cho sản phẩm
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy danh sách sản phẩm theo CategoryID

}