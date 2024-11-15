<?php
include_once '../common/function.php';
include_once '../common/env.php';
function loadall_category(){
    $sql="select * from categories order by CategoryID desc";
    $listcategori=pdo_query($sql);
    return  $listcategori;
}
function load_ten_dm($iddm){
    if($iddm>0){
        $sql="select * from categories where CategoryID=".$iddm;
        $dm=pdo_query_one($sql);
        extract($dm);
        return $CategoryName;
    }else{
        return "";
    }
}
function insert_dm($tenLoai) {
    $sql = "INSERT INTO `categories`(`CategoryName`) VALUES ('$tenLoai')";
    pdo_execute($sql);
}
function delete_dm($CategoryID ) {
    $sql = 'DELETE FROM `categories` WHERE CategoryID='.$CategoryID ;
    pdo_execute($sql);
}
function loadone_dm($CategoryID) {
    $sql = 'SELECT * FROM categories WHERE CategoryID = :CategoryID';
    $stmt = connectDB()->prepare($sql);
    $stmt->execute([':CategoryID' => $CategoryID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function updateCategory($categoryID, $categoryName) {
    $sql = "UPDATE Categories SET CategoryName = :CategoryName WHERE CategoryID = :CategoryID";
    $params = [
        ':CategoryName' => $categoryName,
        ':CategoryID' => $categoryID
    ];
    pdo_execute($sql, $params);
}

