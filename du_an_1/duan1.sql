-- Roles: Lưu trữ thông tin về các vai trò người dùng như Admin, User, Moderator, Supplier
-- Tạo bảng Roles
CREATE TABLE Roles (
    RoleID INT PRIMARY KEY AUTO_INCREMENT,  -- Khóa chính, tự động tăng, lưu ID vai trò
    RoleName VARCHAR(50) UNIQUE NOT NULL     -- Tên vai trò, không trùng lặp và không để trống
);

-- Thêm dữ liệu mẫu cho bảng Roles
INSERT INTO Roles (RoleName) VALUES ('Admin'), ('User'), ('Moderator'), ('Supplier');  -- Thêm các vai trò mẫu vào bảng Roles


-- Users: Lưu trữ thông tin người dùng, bao gồm tên, email, mật khẩu và vai trò
-- Tạo bảng Users với cột RoleID
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,    -- Khóa chính, tự động tăng, lưu ID người dùng
    UserName VARCHAR(100) NOT NULL,           -- Tên người dùng, không để trống
    Email VARCHAR(100) UNIQUE NOT NULL,       -- Địa chỉ email, không trùng lặp và không để trống
    PasswordHash VARCHAR(255) NOT NULL,       -- Mã băm mật khẩu, không để trống
    Address VARCHAR(255),                      -- Địa chỉ người dùng (có thể để trống)
    PhoneNumber VARCHAR(15),                  -- Số điện thoại (có thể để trống)
    RoleID INT,                                -- ID vai trò, liên kết đến bảng Roles
    FOREIGN KEY (RoleID) REFERENCES Roles(RoleID)  -- Ràng buộc khóa ngoại với bảng Roles
);

-- Categories: Lưu trữ các danh mục sản phẩm
-- Tạo bảng Categories
CREATE TABLE Categories (
    CategoryID INT PRIMARY KEY AUTO_INCREMENT,  -- Khóa chính, tự động tăng, lưu ID danh mục
    CategoryName VARCHAR(100) NOT NULL          -- Tên danh mục, không để trống
);

-- Products: Lưu trữ thông tin sản phẩm bao gồm tên, mô tả, giá và danh mục
-- Tạo bảng Products 
CREATE TABLE Products (
    ProductID INT PRIMARY KEY AUTO_INCREMENT,   -- Khóa chính, tự động tăng, lưu ID sản phẩm
    ProductName VARCHAR(100) NOT NULL,          -- Tên sản phẩm, không để trống
    Description TEXT,                            -- Mô tả sản phẩm (có thể để trống)
    Price DECIMAL(10, 2) NOT NULL,              -- Giá sản phẩm, không để trống
    CategoryID INT,                              -- ID danh mục, liên kết đến bảng Categories
    ImageURL VARCHAR(255),                       -- URL hình ảnh sản phẩm (có thể để trống)
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)  -- Ràng buộc khóa ngoại với bảng Categories
);

-- Orders: Lưu trữ thông tin đơn hàng, bao gồm người dùng đã đặt hàng, ngày đặt và tổng số tiền
-- Tạo bảng Orders
CREATE TABLE Orders (
    OrderID INT PRIMARY KEY AUTO_INCREMENT,      -- Khóa chính, tự động tăng, lưu ID đơn hàng
    UserID INT,                                  -- ID người dùng, liên kết đến bảng Users
    OrderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Ngày đặt hàng, mặc định là thời điểm hiện tại
    TotalAmount DECIMAL(10, 2),                  -- Tổng số tiền đơn hàng (có thể để trống)
    Status VARCHAR(50),                          -- Trạng thái đơn hàng (có thể để trống)
    FOREIGN KEY (UserID) REFERENCES Users(UserID)  -- Ràng buộc khóa ngoại với bảng Users
);

-- OrderDetails: Lưu trữ thông tin chi tiết về từng sản phẩm trong đơn hàng
-- Tạo bảng OrderDetails
CREATE TABLE OrderDetails (
    OrderDetailID INT PRIMARY KEY AUTO_INCREMENT,  -- Khóa chính, tự động tăng, lưu ID chi tiết đơn hàng
    OrderID INT,                                  -- ID đơn hàng, liên kết đến bảng Orders
    ProductID INT,                                -- ID sản phẩm, liên kết đến bảng Products
    Quantity INT,                                 -- Số lượng sản phẩm trong đơn hàng
    UnitPrice DECIMAL(10, 2),                     -- Giá mỗi sản phẩm tại thời điểm đặt hàng
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),  -- Ràng buộc khóa ngoại với bảng Orders
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)  -- Ràng buộc khóa ngoại với bảng Products
);


-- Tạo bảng Reviews
CREATE TABLE Reviews (
    ReviewID INT PRIMARY KEY AUTO_INCREMENT,      -- Khóa chính, tự động tăng, lưu ID đánh giá
    ProductID INT,                                -- ID sản phẩm, liên kết đến bảng Products
    UserID INT,                                   -- ID người dùng, liên kết đến bảng Users
    Rating INT CHECK (Rating BETWEEN 1 AND 5),    -- Đánh giá từ 1 đến 5
    Comment TEXT,                                 -- Nhận xét (có thể để trống)
    ReviewDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Ngày đánh giá, mặc định là thời điểm hiện tại
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID),  -- Ràng buộc khóa ngoại với bảng Products
    FOREIGN KEY (UserID) REFERENCES Users(UserID)  -- Ràng buộc khóa ngoại với bảng Users
);

