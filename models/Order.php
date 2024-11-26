<?php

class Order
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả danh mục
    public function getAllOrders()
    {
        try {
            $sql = "SELECT u.*, r.name, 
            c.statusName
            FROM orders u 
            LEFT JOIN statusorder c ON u.Status = c.OrderID
            LEFT JOIN users r ON u.UserID = r.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    public function getAllOrderDetail($OrderID)
    {
        try {
            $sql = "SELECT u.*, r.name, 
            c.statusName
            FROM orders u 
            LEFT JOIN statusorder c ON u.Status = c.OrderID
            LEFT JOIN users r ON u.UserID = r.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':OrderID', $OrderID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    public function deleteOrder($OrderID)
    {
        try {
            $sql = "DELETE FROM orders WHERE OrderID = :OrderID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':OrderID', $OrderID, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    // Hủy kết nối
    public function __destruct()
    {
        $this->conn = null;
    }
}
