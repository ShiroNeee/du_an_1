<?php

class Order
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả danh mục
    public function getAllOrders($limit, $offset)
    {
        try {
            $sql = "SELECT u.*, r.name, 
            c.statusName,
            p.image
            FROM orders u
            LEFT JOIN statusorder c ON u.Status = c.OrderID
            LEFT JOIN users r ON u.UserID = r.id
            LEFT JOIN products p ON u.ProductID = p.id
            ORDER BY CASE 
            WHEN c.OrderID = 3 THEN 1  -- Trạng thái thành công (OrderID = 3) lên đầu
            WHEN c.OrderID = 2 THEN 2  -- Trạng thái đang giao hàng (OrderID = 2) ở giữa
            WHEN c.OrderID = 1 THEN 3  -- Trạng thái đang chuẩn bị hàng (OrderID = 1) ở dưới 
            ELSE 4                     -- Các trạng thái khác (OrderID khác) ở dưới nữa
            END, u.OrderID DESC  -- Sắp xếp theo OrderID của đơn hàng (giảm dần)
            LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    public function getTotalOrders()
    {
        try {
            $sql = "SELECT COUNT(*) FROM orders";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }

    //Lấy ra chi tiết sản phẩm oder theo id
    public function getOrderDetail($OrderID)
    {
        try {
            $sql = "SELECT u.*, r.name, 
            c.statusName
            FROM orders u 
            LEFT JOIN statusorder c ON u.Status = c.OrderID
            LEFT JOIN users r ON u.UserID = r.id 
            WHERE u.OrderID = :OrderID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':OrderID', $OrderID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function getAllStatusorder()
    {
        try {

            $sql = "SELECT * FROM statusorder";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function getAllProduct()
    {
        try {

            $sql = "SELECT * FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function getAllOrdersByUser($userID)
    {
        try {
            $sql = "SELECT u.*, r.name, 
            c.statusName,
            p.image
            FROM orders u 
            LEFT JOIN statusorder c ON u.Status = c.OrderID
            LEFT JOIN users r ON u.UserID = r.id 
            LEFT JOIN products p ON u.ProductID = p.id
            WHERE UserID = :userID";
            // Giả sử bạn đang sử dụng PDO để thực thi truy vấn
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    //
    public function updateData($OrderID, $UserID, $OrderDate, $TotalAmount, $Status, $ProductID, $Quantity)
    {
        try {
            $sql = "UPDATE orders SET 
                    UserID = :UserID,
                    OrderDate = :OrderDate,
                    TotalAmount = :TotalAmount,
                    Status = :Status,
                    ProductID = :ProductID,
                    Quantity = :Quantity
                WHERE OrderID = :OrderID";
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':OrderID', $OrderID, PDO::PARAM_INT);
            $stmt->bindParam(':UserID', $UserID);
            $stmt->bindParam(':OrderDate', $OrderDate);
            $stmt->bindParam(':TotalAmount', $TotalAmount);
            $stmt->bindParam(':Status', $Status);
            $stmt->bindParam(':ProductID', $ProductID);
            $stmt->bindParam(':Quantity', $Quantity);

            // Thực thi câu truy vấn
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function updateOrderStatus($orderID, $newStatus)
    {
        try {
            $sql = "UPDATE orders SET Status = :status WHERE OrderID = :orderID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':status', $newStatus, PDO::PARAM_INT);
            $stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
            return $stmt->execute(); // Trả về true nếu cập nhật thành công, false nếu thất bại
        } catch (PDOException $e) {
            error_log("Error updating order status: " . $e->getMessage());
            return false;
        }
    }
    public function addOrder($orderData)
    {
        try {
            // Câu lệnh SQL để thêm đơn hàng vào bảng orders
            $sql = "INSERT INTO orders (OrderID, ProductID, UserID, Quantity, TotalAmount, Status, OrderDate) 
                VALUES (:OrderID, :ProductID, :UserID, :Quantity, :TotalAmount, :Status, :OrderDate)";

            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':OrderID', $orderData['OrderID']);
            $stmt->bindParam(':ProductID', $orderData['ProductID']);
            $stmt->bindParam(':UserID', $orderData['UserID']);
            $stmt->bindParam(':Quantity', $orderData['Quantity']);
            $stmt->bindParam(':TotalAmount', $orderData['TotalAmount']);
            $stmt->bindParam(':Status', $orderData['Status']);
            $stmt->bindParam(':OrderDate', $orderData['OrderDate']);

            // Thực thi câu truy vấn
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
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
