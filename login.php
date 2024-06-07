<?php
require "connection.php";
if (isset($_POST['Username'])) {
    $sql = "SELECT COUNT(*) AS Count
        FROM accounts
        WHERE Username=:Username AND Password=:Password";
    $result = ExecuteSelectQuery($sql, $_POST);
    if ($result[0]->Count == 1) {
        header("location: products/product.php");
    } else {
        echo "đăng nhập thất bại";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title></title>
</head>

<body>
    <div class="container">
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="Username">Tên đăng nhập</label>
                <input id="Username" class="form-control" type="text" name="Username">
            </div>
            <div class="form-group">
                <label for="Password">Mật khẩu</label>
                <input id="Password" class="form-control" type="password" name="Password">
            </div>
            <button method="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>