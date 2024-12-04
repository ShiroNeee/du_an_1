<?php
class CommentModel
{
    public $conn;
    // Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllComments()
    {
        $query = "SELECT * FROM comments ORDER BY date DESC"; // Sử dụng date thay vì CreatedAt
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy bình luận theo ID
    public function getCommentById($id)
    {
        $query = "SELECT * FROM comments WHERE CommentID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm mới bình luận
    public function addComment($ProductID, $UserID, $Content, $OrderID)
{
    $query = "INSERT INTO comments (ProductID, UserID, Content, OrderID, date) 
              VALUES (:ProductID, :UserID, :Content, :OrderID, :date)";
    $stmt = $this->conn->prepare($query);
    $currentDate = date('Y-m-d H:i:s'); // Lấy ngày hiện tại
    $stmt->bindParam(':ProductID', $ProductID, PDO::PARAM_INT);
    $stmt->bindParam(':UserID', $UserID, PDO::PARAM_INT);
    $stmt->bindParam(':Content', $Content, PDO::PARAM_STR);
    $stmt->bindParam(':OrderID', $OrderID, PDO::PARAM_INT);
    $stmt->bindParam(':date', $currentDate, PDO::PARAM_STR);

    return $stmt->execute(); // Thêm bình luận thành công
}


    // Cập nhật bình luận
    public function updateComment($id, $data)
{
    $query = "UPDATE comments 
              SET ProductID = :ProductID, UserID = :UserID, Content = :Content, date = :date, OrderID = :OrderID 
              WHERE CommentID = :id";
    $stmt = $this->conn->prepare($query);
    
    // Kiểm tra ngày hoặc gán ngày hiện tại nếu không có
    $data['date'] = !empty($data['date']) ? $data['date'] : date('Y-m-d H:i:s');
    
    $stmt->bindParam(':ProductID', $data['ProductID'], PDO::PARAM_INT);
    $stmt->bindParam(':UserID', $data['UserID'], PDO::PARAM_INT);
    $stmt->bindParam(':Content', $data['Content'], PDO::PARAM_STR);
    $stmt->bindParam(':date', $data['date'], PDO::PARAM_STR);
    $stmt->bindParam(':OrderID', $data['OrderID'], PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

    // Xóa bình luận
    public function deleteComment($id)
    {
        $query = "DELETE FROM comments WHERE CommentID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getAllProducts()
    {
        $query = "SELECT id, ProductName FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $query = "SELECT id, name FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
