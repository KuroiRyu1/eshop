<?php
require "../connection.php";
 $sql = "SELECT * FROM accounts";
 $accounts = ExecuteSelectQuery($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title></title>
</head>
<body>
  <div class="container">
    <table class="table table-light">
        <thead class="thead-dark">
            <tr>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Họ và tên</th>
            </tr>
        </thead>
        <tbody>
           
                <?php
                foreach ($accounts as $item) {
                    ?>
                     <tr>
                        <td><?= $item->Username ?></td>
                        <td><?= $item->Email ?></td>
                        <td><?= $item->Phone ?></td>
                        <td><?= $item->Address ?></td>
                        <td><?= $item->FullName ?></td>
                    </tr>
                    <?php
                }
                ?>
            
        </tbody>
    </table>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>