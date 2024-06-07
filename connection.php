<?php
function OpenConnection($servername = "localhost:3308", $username = "root", $password = "", $dbname = "eshop")
{
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Có lỗi xảy ra: " . $e->getMessage();
        exit();
    }
}

function ExecuteSelectQuery($sql, $params = null)
{
    $conn = OpenConnection();
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $conn = null;
        return $result;
    } catch (PDOException $e) {
        echo "Có lỗi xảy ra: " . $e->getMessage();
        exit();
    }
}

function ExecuteNonQuery($sql, $params = null)
{
    $conn = OpenConnection();
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $conn = null;
        return $stmt;
    } catch (PDOException $e) {
        echo "Có lỗi xảy ra: " . $e->getMessage();
        exit();
    }
}