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
    public function getCategoryName($id)
    {
        try {
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
    public function deleteCategory($id)
    {
        try {
            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Lấy thông tin chi tiết danh mục theo ID
    public function getCategoryDetail($id)
    {
        try {
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    // Cập nhật danh mục
    public function updateCategory($id, $categoryName)
    {
        try {
            $sql = "UPDATE categories SET categoryName = :categoryName WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':categoryName', $categoryName);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }


    public function showCategories()
    {
        $sql = "SELECT id, categoryName FROM categories";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    public function getCategoryById($categoryId)
{
    $sql = "SELECT * FROM categories WHERE id = :id LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    
    // Hủy kết nối
    public function __destruct()
    {
        $this->conn = null;
    }
}
