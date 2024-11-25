<?php
class Statistic
{
    public $conn;
    // Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getChartData()
    {
        $thongke = "SELECT c.id AS CategoryID, 
                           c.categoryName AS CategoryName,
                           COUNT(p.id) AS ProductCount FROM categories c 
                           LEFT JOIN products p ON c.id = p.CategoryID 
                           GROUP BY c.id, c.categoryName;";
        $stmt = $this->conn->query($thongke);
        if ($stmt === false) {
            throw new Exception("Query failed: " . implode(", ", $this->conn->errorInfo()));
        }
        $data = [['Danh mục sản phẩm', 'Số lượng']];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
            $data[] = [$row['CategoryName'], (int)$row['ProductCount']];
        }
        return $data;
    }
}
