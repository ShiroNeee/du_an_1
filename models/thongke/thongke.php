<?php
class ThongKe
{
    public $conn;

    // Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getDoanhThuYear()
    {
        $sql = "SELECT YEAR(OrderDate) as Nam, SUM(TotalAmount) as DoanhThu 
        FROM orders GROUP BY YEAR(OrderDate)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDoanhThuMonth()
    {
        $sql = "SELECT DATE_FORMAT(OrderDate, '%Y-%m') AS Thang, 
        SUM(TotalAmount) AS DoanhThu FROM orders
        GROUP BY DATE_FORMAT(OrderDate, '%Y-%m')
        ORDER BY DATE_FORMAT(OrderDate, '%Y-%m')";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDoanhThuWeek()
    {
        $sql = "SELECT YEAR(OrderDate) AS Nam, WEEK(OrderDate) AS Tuan,
        SUM(TotalAmount) AS DoanhThu FROM orders
        GROUP BY YEAR(OrderDate), WEEK(OrderDate)
        ORDER BY YEAR(OrderDate), WEEK(OrderDate)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDoanhThuDay()
    {
        $sql = "SELECT DATE(OrderDate) AS Ngay,
        SUM(TotalAmount) AS DoanhThu FROM orders
        GROUP BY DATE(OrderDate)
        ORDER BY DATE(OrderDate)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
