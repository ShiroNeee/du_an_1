<?php
class Product
{
    public $conn;

    // Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }
    // Lấy ra toàn bộ sản phẩm
    public function getAllProduct($limit = 5, $offset = 0)
    {
        try {
            $sql = "SELECT u.*, r.statusName, c.CategoryName 
                FROM products u
                LEFT JOIN status r ON u.status = r.statusID
                LEFT JOIN categories c ON u.CategoryID = c.CategoryID
                ORDER BY 
                    CASE 
                        WHEN u.status = 1 THEN 0  -- Còn hàng lên trên cùng
                        WHEN u.status = 0 THEN 1  -- Hết hàng xuống dưới cùng
                        ELSE 2  -- Các trạng thái khác (nếu có) xuống dưới nữa
                    END, 
                    u.id DESC
                LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // Lấy tổng số sản phẩm để tính số trang
    public function getTotalProductCount()
    {
        try {
            $sql = "SELECT COUNT(*) FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // Thêm sản phẩm 
    public function postData($ProductName, $Description, $Price, $CategoryID, $status, $image)
    {
        try {
            $sql = "INSERT INTO products (ProductName, Description, Price, CategoryID, status, image) VALUES (:ProductName, :Description, :Price, :CategoryID, :status, :image)";
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':ProductName', $ProductName);
            $stmt->bindParam(':Description', $Description);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':CategoryID', $CategoryID);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':image', $image);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // Lấy thông tin chi tiết sản phẩm
    public function getDetail($id)
    {
        try {
            $sql = "SELECT u.*, r.statusName, 
                    c.CategoryName 
            FROM products u
            LEFT JOIN status r ON u.status = r.statusID
            LEFT JOIN categories c ON u.CategoryID = c.CategoryID
            WHERE u.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function getStatusList()
    {
        try {
            $sql = "SELECT * FROM status";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function getCategoryList()
    {
        try {
            $sql = "SELECT * FROM categories";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function searchProductsByName($name)
    {
        try {
            // Truy vấn tìm các sản phẩm có tên chứa từ khóa tìm kiếm
            $sql = "SELECT * 
        FROM products 
        WHERE ProductName LIKE :name AND status = 1";
            $stmt = $this->conn->prepare($sql);

            // Tạo chuỗi từ khóa tìm kiếm (thêm dấu % trước và sau để tìm kiếm theo phần)
            $searchTerm = "%" . $name . "%";
            $stmt->bindParam(':name', $searchTerm, PDO::PARAM_STR);

            // Thực thi câu truy vấn
            $stmt->execute();

            // Trả về danh sách sản phẩm tìm được
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    // Xoá sản phẩm
    public function deleteData($id)
    {
        try {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }


    public function showProductHome($limit = 10)
    {
        try {
            // Câu lệnh SQL lấy sản phẩm còn hàng (Status = 1), sắp xếp theo id giảm dần và giới hạn số lượng sản phẩm
            $sql = "SELECT * FROM products WHERE Status = 1 ORDER BY id DESC LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    public function getProductsByCategoryId($categoryId)
    {
        $query = "SELECT * FROM products WHERE CategoryID = :categoryId AND status = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($productId)
    {
        $query = "SELECT * FROM products WHERE id = :productId AND status = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Hủy kết nối
    public function __destruct()
    {
        $this->conn = null;
    }
    // add data
    public function addData($ProductName, $Description, $Price, $CategoryID, $status, $image)
    {
        try {
            $sql = "INSERT INTO products 
                    (ProductName, Description, Price, CategoryID, status, image)
                    VALUES (:ProductName, :Description, :Price, :CategoryID, :status, :image) ";
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':ProductName', $ProductName);
            $stmt->bindParam(':Description', $Description);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':CategoryID', $CategoryID);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':image', $image);

            // Thực thi câu truy vấn
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // update data
    public function updateDataProduct($id, $ProductName, $Description, $Price, $CategoryID, $status, $image)
    {
        try {
            $sql = "UPDATE products SET 
                    ProductName = :ProductName,
                    Description = :Description,
                    Price       = :Price,
                    CategoryID  = :CategoryID,
                    status      = :status,
                    image       = :image
                WHERE id        = :id";
            $stmt = $this->conn->prepare($sql);
            // Gán giá trị cho các tham số
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':ProductName', $ProductName);
            $stmt->bindParam(':Description', $Description);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':CategoryID', $CategoryID);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':image', $image);
            // Thực thi câu truy vấn
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // Lấy thông tin sản phẩm theo ID
    public function getProductSizes($productID)
    {
        $query = "SELECT s.SizeID, s.Size, s.StockQuantity
        FROM sizes s
        WHERE s.ProductID = :productID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
        $stmt->execute();

        // Trả về danh sách kích cỡ và số tồn kho cho sản phẩm
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách sản phẩm theo CategoryID
    public function getRandomProducts($limit = 4)
    {
        $query = "SELECT * FROM products ORDER BY RAND() LIMIT :limit"; // Truy vấn trực tiếp bảng "products"
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT); // Gắn số lượng sản phẩm cần lấy
        $stmt->execute();

        // Trả về kết quả dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentsByProduct($productId) {
        $stmt = $this->conn->prepare("SELECT comments.*, users.name as userName FROM comments
                                      JOIN users ON comments.UserID = users.id
                                      WHERE ProductID = :productId
                                      ORDER BY CreatedAt DESC");
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

// Thêm bình luận
public function addComment($productId, $content, $orderId) {
    // Kiểm tra session và lấy UserID từ session
    if (!isset($_SESSION['user_id'])) {
        // Nếu người dùng chưa đăng nhập, có thể báo lỗi hoặc chuyển hướng đến trang đăng nhập
        echo "Vui lòng đăng nhập để thêm bình luận!";
        exit;
    }

    $userId = $_SESSION['user_id'];  // Lấy UserID từ session
    $createdAt = date('Y-m-d H:i:s');
    
    // Chuẩn bị và thực thi câu lệnh SQL để thêm bình luận
    $stmt = $this->conn->prepare("INSERT INTO comments (ProductID, UserID, Content, CreatedAt, OrderID) 
                                  VALUES (:productId, :userId, :content, :createdAt, :orderId)");
    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':createdAt', $createdAt);
    $stmt->bindParam(':orderId', $orderId);
    $stmt->execute();
}


}
