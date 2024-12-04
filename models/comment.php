<?php

class CommentModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    // Lấy tất cả các bình luận, bao gồm thông tin người dùng và sản phẩm
    public function getAll()
    {
        try {
            $sql = "SELECT c.*, u.username AS UserName, p.ProductName 
                    FROM comments c
                    LEFT JOIN users u ON c.UserID = u.id
                    LEFT JOIN products p ON c.ProductID = p.id";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Lấy bình luận theo sản phẩm
    public function getByProductID($productID)
    {
        try {
            $sql = "SELECT c.*, u.name AS UserName
                    FROM comments c
                    LEFT JOIN users u ON c.UserID = u.id
                    WHERE c.ProductID = :productID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Thêm bình luận mới
    public function addComment($data)
    {
        try {
            $sql = "INSERT INTO comments (ProductID, UserID, Content, date, OrderID) 
                VALUES (:ProductID, :UserID, :Content, NOW(), :OrderID)";
            $stmt = $this->conn->prepare($sql);

            // Debug: in câu truy vấn SQL và dữ liệu truyền vào
            var_dump($sql);  // In câu truy vấn SQL
            var_dump($data); // In dữ liệu

            // Gán giá trị cho các tham số
            $stmt->bindValue(':ProductID', $data['ProductID'], PDO::PARAM_INT);
            $stmt->bindValue(':UserID', $data['UserID'], PDO::PARAM_INT);
            $stmt->bindValue(':Content', $data['Content'], PDO::PARAM_STR);
            $stmt->bindValue(':OrderID', $data['OrderID'], PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi thêm bình luận: " . $e->getMessage());
        }
    }
    public function getCommentsByUserAndProduct($userID, $productID)
    {
        try {
            $sql = "SELECT * FROM comments WHERE UserID = :userID AND ProductID = :productID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
    
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về tất cả các bình luận của sản phẩm cho người dùng này
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi lấy bình luận: " . $e->getMessage());
        }
    }

}
