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
            p.image,s.Size
            FROM orders u
            LEFT JOIN statusorder c ON u.Status = c.OrderID
            LEFT JOIN users r ON u.UserID = r.id
            LEFT JOIN products p ON u.ProductID = p.id
            LEFT JOIN sizes s ON u.Size = s.SizeID
             ORDER BY 
                CASE 
                    WHEN c.OrderID = 1 THEN 1
                    WHEN c.OrderID = 2 THEN 2
                    WHEN c.OrderID = 3 THEN 3
                    WHEN c.OrderID = 0 THEN 4
                    ELSE 5
                END, u.OrderID DESC
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
    public function getTotalQuantity()
    {
        try {
            // Truy vấn để tính tổng số lượng của tất cả đơn hàng
            $sql = "SELECT SUM(Quantity) AS totalQuantity FROM orders";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Trả về tổng số lượng
            return $result['totalQuantity'];
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }
    public function getTotalQuantityAfterPayment()
    {
        try {
            // Truy vấn để tính tổng số lượng của các đơn hàng có trạng thái thành công (giả sử trạng thái "thành công" là 3)
            $sql = "SELECT SUM(Quantity) AS totalQuantity FROM orders WHERE Status = 3";  // Trạng thái = 3 là đã thanh toán thành công
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Trả về tổng số lượng
            return $result['totalQuantity'];
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }
    public function doanhThu()
    {
        try {
            // Truy vấn để tính tổng tiền của các đơn hàng có trạng thái thành công (giả sử trạng thái "thành công" là 3)
            $sql = "SELECT SUM(TotalAmount) AS totalRevenue FROM orders WHERE Status = 3";  // Trạng thái = 3 là đã thanh toán thành công
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Trả về tổng doanh thu
            return $result['totalRevenue'];
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
            c.statusName,
            s.Size
            FROM orders u 
            LEFT JOIN statusorder c ON u.Status = c.OrderID
            LEFT JOIN users r ON u.UserID = r.id 
            LEFT JOIN sizes s ON u.Size = s.SizeID
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
    public function getAllSizesByProductID($ProductID)
    {
        try {

            $sql = "SELECT s.SizeID, s.Size 
            FROM sizes s
            WHERE s.ProductID = :ProductID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ProductID', $ProductID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function getOrderDetailByProductSize($ProductID, $Size)
    {
        try {
            $sql = "SELECT OrderID FROM orders WHERE ProductID = :ProductID AND Size = :Size";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ProductID', $ProductID, PDO::PARAM_INT);
            $stmt->bindParam(':Size', $Size, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về OrderID nếu tìm thấy
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
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
            p.image,
            p.ProductName,
            s.SizeID,
            s.Size AS Size,
            s.StockQuantity
            FROM orders u 
            LEFT JOIN statusorder c ON u.Status = c.OrderID
            LEFT JOIN users r ON u.UserID = r.id 
            LEFT JOIN products p ON u.ProductID = p.id
            LEFT JOIN sizes s ON u.Size = s.SizeID
            WHERE UserID = :userID AND u.Status = 1";
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
    public function getAllOrdersByUserExcludePending($userID)
    {
        try {
            $sql = "SELECT u.*, r.name, 
                c.statusName,
                p.image,
                p.ProductName,
                s.SizeID,
                s.Size AS Size,
                s.StockQuantity
                FROM orders u 
                LEFT JOIN statusorder c ON u.Status = c.OrderID
                LEFT JOIN users r ON u.UserID = r.id 
                LEFT JOIN products p ON u.ProductID = p.id
                LEFT JOIN sizes s ON u.Size = s.SizeID
                WHERE u.UserID = :userID AND u.Status != 1"; // Loại bỏ trạng thái '1' (chưa thanh toán)

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
    public function updateData($OrderID, $UserID, $OrderDate, $Size, $TotalAmount, $Status, $ProductID, $Quantity)
    {
        try {
            $sql = "UPDATE orders SET 
                    UserID = :UserID,
                    OrderDate = :OrderDate,
                    Size = :Size,
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
            $stmt->bindParam(':Size', $Size);
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
    public function updateOrderStatus($OrderID, $Status)
    {
        try {
            $sql = "UPDATE orders SET Status = :Status WHERE OrderID = :OrderID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':OrderID', $OrderID, PDO::PARAM_INT);
            $stmt->bindParam(':Status', $Status, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    // public function updateOrderStatus($orderID, $userID, $productID, $newStatus)
    // {
    //     try {
    //         // Cập nhật trạng thái và thêm thời gian hoàn tất nếu là trạng thái 2
    //         $sql = "UPDATE orders 
    //             SET Status = :status, 
    //                 CompletedAt = CASE WHEN :status = 2 THEN NOW() ELSE CompletedAt END
    //             WHERE OrderID = :orderID 
    //             AND UserID = :userID 
    //             AND ProductID = :productID";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bindParam(':status', $newStatus, PDO::PARAM_INT);
    //         $stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
    //         $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    //         $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
    //         return $stmt->execute();
    //     } catch (PDOException $e) {
    //         error_log("Error updating order status: " . $e->getMessage());
    //         return false;
    //     }
    // }

    public function getOrderByProductAndSize($userID, $productID, $sizeID)
    {
        $query = "SELECT * FROM orders WHERE UserID = :UserID AND ProductID = :ProductID AND Size = :SizeID";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':UserID' => $userID,
            ':ProductID' => $productID,
            ':SizeID' => $sizeID,
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addOrUpdateOrder($orderData)
    {
        try {
            // Kiểm tra nếu đơn hàng đã tồn tại
            $sqlCheck = "SELECT * FROM orders 
                     WHERE ProductID = :ProductID AND Size = :Size AND UserID = :UserID";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->bindParam(':ProductID', $orderData['ProductID']);
            $stmtCheck->bindParam(':Size', $orderData['Size']);
            $stmtCheck->bindParam(':UserID', $orderData['UserID']);
            $stmtCheck->execute();

            $existingOrder = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if ($existingOrder) {
                // Nếu tồn tại, cập nhật số lượng và tổng tiền
                $newQuantity = $existingOrder['Quantity'] + $orderData['Quantity'];
                $newTotalAmount = $existingOrder['TotalAmount'] + $orderData['TotalAmount'];

                $sqlUpdate = "UPDATE orders 
                          SET Quantity = :Quantity, TotalAmount = :TotalAmount 
                          WHERE OrderID = :OrderID";
                $stmtUpdate = $this->conn->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':Quantity', $newQuantity);
                $stmtUpdate->bindParam(':TotalAmount', $newTotalAmount);
                $stmtUpdate->bindParam(':OrderID', $existingOrder['OrderID']);
                return $stmtUpdate->execute();
            } else {
                // Nếu chưa tồn tại, thêm mới
                $sqlInsert = "INSERT INTO orders (ProductID, UserID, Quantity, Size, TotalAmount, Status, OrderDate) 
                          VALUES (:ProductID, :UserID, :Quantity, :Size, :TotalAmount, :Status, :OrderDate)";
                $stmtInsert = $this->conn->prepare($sqlInsert);
                $stmtInsert->bindParam(':ProductID', $orderData['ProductID']);
                $stmtInsert->bindParam(':UserID', $orderData['UserID']);
                $stmtInsert->bindParam(':Quantity', $orderData['Quantity']);
                $stmtInsert->bindParam(':Size', $orderData['Size']);
                $stmtInsert->bindParam(':TotalAmount', $orderData['TotalAmount']);
                $stmtInsert->bindParam(':Status', $orderData['Status']);
                $stmtInsert->bindParam(':OrderDate', $orderData['OrderDate']);
                return $stmtInsert->execute();
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    public function cancelOrder($OrderID)
    {
        try {
            // Cập nhật trạng thái của đơn hàng thành 1 (chưa thanh toán)
            $sql = "UPDATE orders SET Status = 1 WHERE OrderID = :OrderID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':OrderID', $OrderID, PDO::PARAM_INT);

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
