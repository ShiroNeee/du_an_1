<?php
class User
{
    public $conn;
    //  kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy ra toàn bộ dữ liệu
    public function getAll()
    {
        try {
            $sql = "SELECT * FROM users";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function checkLogin($email, $password)
    {
        try {
            // Truy vấn kiểm tra email và mật khẩu trong cơ sở dữ liệu
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':email', $email);

            $stmt->execute();

            // Lấy ra người dùng (nếu có)
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            echo 'Lỗi: ' .  $e->getMessage();
            return false;
        }
    }
    
    // Thêm dữ liệu
    public function postData($name, $email, $password, $phoneNumber, $address, $roleID, $image)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Viết câu truy vấn
            $sql = "INSERT INTO users
            (name,  email, password, phoneNumber, address, roleID, image)
            VALUES
            (:name, :email, :password, :phoneNumber, :address, :roleID, :image)";
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':roleID', $roleID);
            $stmt->bindParam(':image', $image);
            // Thực thi câu truy vấn
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // Hàm lấy thông tin chi tiết
    public function getDetail($id)
    {
        try {
            $sql_detail = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql_detail);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    // cập nhật dữ liệu
    public function updateData($id, $name, $email, $password, $phoneNumber, $address, $roleID, $image)
    {
        try {
            $sql = "UPDATE users SET 
                    name = :name,
                    email = :email,
                    password = :password,
                    phoneNumber = :phoneNumber,
                    address = :address,
                    roleID = :roleID,
                    image = :image
                WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':roleID', $roleID);
            $stmt->bindParam(':image', $image);

            // Thực thi câu truy vấn
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    //xoá thông tin 
    public function deleteData($id)
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    // huỷ kết nối CSDL
    public function __destruct()
    {
        $this->conn = null;
    }
}
