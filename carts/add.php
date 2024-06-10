<?php
session_start();
require "../connection.php";

$sql = "SELECT *
        FROM carts
        WHERE AccountId=:AccountId AND ProductId=:ProductId";
$params = [
    "AccountId" => $_SESSION['Id'],
    "ProductId" => $_POST['id']
];
$carts = ExecuteSelectQuery($sql, $params);

// Giỏ hàng chưa có sản phẩm tương ứng
if (count($carts) == 0) {
    $sql = "INSERT INTO carts (AccountId, ProductId, Quantity)
            VALUES (:AccountId, :ProductId, :Quantity)";
    $params = [
        "AccountId" => $_SESSION['Id'],
        "ProductId" => $_POST['id'],
        "Quantity" => 1
    ];
}
// Giỏ hàng đã có sản phẩm tương ứng
else {
    $sql = "UPDATE carts
            SET Quantity = Quantity + 1
            WHERE AccountId=:AccountId AND ProductId=:ProductId";
    $params = [
        "AccountId" => $_SESSION['Id'],
        "ProductId" => $_POST['id']
    ];
}
$result = ExecuteNonQuery($sql, $params);
if ($result->rowCount() == 1) {
    header("Location: index.php");
}