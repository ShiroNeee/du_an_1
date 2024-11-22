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
        $thongke = "";
        $stmt = $this->conn->query($thongke);
        if ($stmt === false) {
            throw new Exception("Query failed: " . implode(", ", $this->conn->errorInfo()));
        }
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
            $data[] = [$row['category_name'], (int)$row['number_categories']];
        }
        return $data;
    }
}
