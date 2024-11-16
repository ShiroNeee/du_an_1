<?php

function connectDB()
{
    $host   = DB_HOST;
    $dbname = DB_NAME;
    try {
        $conn = new PDO(
            "mysql:host=$host; dbname=$dbname", 
            DB_USERNAME, 
            DB_PASSWORD
        );
        //thiết lập cơ  chế báo lỗi
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Cài đặt hiển thị dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
        
    } catch (\PDOException $e) {
        echo 'lỗi kết nối cơ sở dữ liệu' . $e->getMessage();
    }
}

// function pdo_execute($sql){
//     $sql_args=array_slice(func_get_args(),1);
//     try{
//         $conn=connectDB();
//         $stmt=$conn->prepare($sql);
//         $stmt->execute($sql_args);

//     }
//     catch(PDOException $e){
//         throw $e;
//     }
//     finally{
//         unset($conn);
//     }
// }
function pdo_execute($sql) {
    // Lấy tất cả tham số sau `$sql`
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}


// truy vấn nhiều dữ liệu
function pdo_query($sql){
    $sql_args=array_slice(func_get_args(),1);

    try{
        $conn=connectDB();
        $stmt=$conn->prepare($sql);
        $stmt->execute($sql_args);
        $rows=$stmt->fetchAll();
        return $rows;
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}

// truy vấn  1 dữ liệu
function pdo_query_one($sql, $params = []) {
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch();
}
?>


