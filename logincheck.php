<?php
session_start();
require "connection.php";

if (!isset($_POST['Username'])) {
    header("Location: index.php");
}

$sql = "SELECT *
        FROM accounts
        WHERE Username = :Username";
$param = ["Username" => $_POST['Username']];
$result = ExecuteSelectQuery($sql, $param);
if (count($result) == 0) {
    echo "Đăng nhập thất bại";
    exit();
}
$account = $result[0];
if ($account->Password != $_POST["Password"]) {
    echo "Đăng nhập thất bại";
    exit();
} else {
    $_SESSION['FullName'] = $account->FullName;
    $_SESSION['Id'] = $account->Id;
    header("Location: index.php");
}