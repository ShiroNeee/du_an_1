<?php
class ThongKeModel
{
    public $conn;

    // Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }
    // model của doanh thu tháng
    public function tongDoanhThuMonth()
    {
        try {
            $sql = "SELECT DATE_FORMAT(OrderDate, '%Y-%m') 
            AS Month,SUM(TotalAmount) 
            AS TotalRevenue FROM orders 
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
            $sql = "SELECT DATE_FORMAT(OrderDate, '%Y-%m-%d') 
                AS Day, SUM(TotalAmount) 
                AS TotalRevenue FROM orders 
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
            $sql = "SELECT YEARWEEK(OrderDate, 1) AS Week, SUM(TotalAmount) AS TotalRevenue
            FROM orders 
            GROUP BY YEARWEEK(OrderDate, 1)
            ORDER BY YEARWEEK(OrderDate, 1) ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }
}
