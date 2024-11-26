<?php

class CategoryManager
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        try {
            $sql = "SELECT * FROM categories";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    // Lấy tên danh mục dựa trên ID
    public function getCategoryName($CategoryID)
    {
        try {
            $sql = "SELECT * FROM categories WHERE CategoryID = :CategoryID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':CategoryID', $CategoryID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    // Thêm danh mục mới
    public function addCategory($categoryName)
    {
        try {
            $sql = "INSERT INTO categories (categoryName) VALUES (:categoryName)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':categoryName', $categoryName);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Xóa danh mục theo ID
    public function deleteCategory($CategoryID)
    {
        try {
            $sql = "DELETE FROM categories WHERE CategoryID = :CategoryID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':CategoryID', $CategoryID, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Lấy thông tin chi tiết danh mục theo ID
    public function getCategoryDetail($CategoryID)
    {
        try {
            $sql = "SELECT * FROM categories WHERE CategoryID = :CategoryID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':CategoryID', $CategoryID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    // Cập nhật danh mục
    public function updateCategory($CategoryID, $categoryName)
    {
        try {
            $sql = "UPDATE categories SET categoryName = :categoryName WHERE CategoryID = :CategoryID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':categoryName', $categoryName);
            $stmt->bindParam(':CategoryID', $CategoryID, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }


    public function showCategories()
    {
        $sql = "SELECT CategoryID, categoryName FROM categories";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin danh mục theo ID
    public function getCategoryById($CategoryID)
    {
        $query = "SELECT * FROM categories WHERE CategoryID = :CategoryID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':CategoryID', $CategoryID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Hủy kết nối
    public function __destruct()
    {
        $this->conn = null;
    }
}
