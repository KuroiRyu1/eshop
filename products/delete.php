<?php
require "../connection.php";

if (!isset($_POST['id'])) {
    header("Location: index.php");
}

$sql = "UPDATE products
        SET Status=0
        WHERE Id=:Id";
$result = ExecuteNonQuery($sql, $_POST);
if ($result->rowCount() == 1) {
    header("Location: index.php");
}