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
    public function getAll()
    {
        try {
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Thêm sản phẩm
    public function postData($ProductName, $Description, $Price, $CategoryID, $image)
    {
        try {
            $sql = "INSERT INTO products 
                    (ProductName, Description, Price, CategoryID, image) 
                    VALUES 
                    (:ProductName, :Description, :Price, :CategoryID, :image)";
            
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':ProductName', $ProductName);
            $stmt->bindParam(':Description', $Description);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':CategoryID', $CategoryID);
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
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
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

// public function getProductsByCategoryId($categoryId) {
//     $sql = "SELECT * FROM products WHERE category_id = :category_id";
//     $stmt = $this->conn->prepare($sql);
//     $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }
public function getProductsByCategoryId($categoryId)
{
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Hủy kết nối
    public function __destruct()
    {
        $this->conn = null;
    }
}
?>