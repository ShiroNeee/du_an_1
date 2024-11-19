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
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    // Thêm sản phẩm 
    public function postData($ProductName, $Description, $Price, $CategoryID,$status, $image)
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

    // Hủy kết nối
    public function __destruct()
    {
        $this->conn = null;
    }
    // add data
    public function addData($ProductName,$Description,$Price,$CategoryID,$status,$image)
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
    public function updateData($id,$ProductName,$Description,$Price,$CategoryID,$status,$image)
    {
        try {
            $sql = "UPDATE products SET 
                    ProductName = :ProductName,
                    Description = :Description,
                    Price = :Price,
                    CategoryID = :CategoryID,
                    status = :status,
                    image = :image
                WHERE id = :id";
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
}