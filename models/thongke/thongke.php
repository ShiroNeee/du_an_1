<?php
class ThongKeModel
{
    public $conn;

    // Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }
    // model của doanh thu theo năm 
    public function tongDoanhThuYear()
    {
        try {
            $sql = "SELECT CONCAT('Năm ', DATE_FORMAT(ANY_VALUE(OrderDate), '%Y')) AS Year, 
            SUM(TotalAmount) AS TotalRevenue FROM orders 
            GROUP BY DATE_FORMAT(OrderDate, '%Y') 
            ORDER BY DATE_FORMAT(OrderDate, '%Y') ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }


    // model của doanh thu tháng
    public function tongDoanhThuMonth()
    {
        try {
            $sql = "SELECT DATE_FORMAT(OrderDate, '%Y-%m') AS Month,
            SUM(TotalAmount) AS TotalRevenue FROM orders 
            GROUP BY DATE_FORMAT(OrderDate, '%Y-%m')
            ORDER BY DATE_FORMAT(OrderDate, '%Y-%m') ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }
    // model của doanh thu ngày
    public function tongDoanhThuDay()
    {
        try {
            $sql = "SELECT DATE_FORMAT(OrderDate, '%Y-%m-%d') AS Day, 
            SUM(TotalAmount) AS TotalRevenue FROM orders 
            GROUP BY DATE_FORMAT(OrderDate, '%Y-%m-%d')
            ORDER BY DATE_FORMAT(OrderDate, '%Y-%m-%d') ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // model của doanh thu tuần
    public function tongDoanhThuWeek()
    {
        try {
            $sql = "SELECT CONCAT('Tuần ', WEEK(ANY_VALUE(OrderDate), 1), ', ', YEAR(ANY_VALUE(OrderDate))) AS Week,
            SUM(TotalAmount) AS TotalRevenue FROM orders
            GROUP BY YEAR(OrderDate), WEEK(OrderDate, 1)
            ORDER BY YEAR(OrderDate), WEEK(OrderDate, 1)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    public function getTotalStockQuantity()
    {
        $query = "SELECT SUM(StockQuantity) as TotalStock FROM sizes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Model: ThongKeModel.php
    public function getStockQuantityBySize()
    {
        $query = "SELECT sizes.Size, SUM(sizes.StockQuantity) as TotalStock FROM sizes GROUP BY sizes.Size";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Trả về mảng kết quả
    }
}
