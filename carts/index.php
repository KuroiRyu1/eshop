<?php
require "../connection.php";

$sql = "SELECT c.Quantity, p.*
        FROM carts c INNER JOIN products p ON c.ProductId = p.Id
        WHERE c.AccountId=:AccountId";
$params = [
    "AccountId" => 3
];
$carts = ExecuteSelectQuery($sql, $params);

$total = 0;
foreach ($carts as $item) {
    $total += $item->Price * $item->Quantity;
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
    <title>Giỏ hàng</title>
</head>

<body>
    <div class="container">
        <h1>Giỏ hàng</h1>

        <table class="table table-light">
            <thead class="thead-dark">
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th>Giá bán (VNĐ)</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($carts as $item) {
                    ?>
                    <tr>
                        <td>
                            <img src="../images/product/<?= $item->Image ?>" style="width: 100px;" />
                        </td>
                        <td><?= $item->Name ?></td>
                        <td><?= $item->Description ?></td>
                        <td><?= number_format($item->Price) ?></td>
                        <td><?= $item->Quantity ?></td>
                        <td>
                            <?= number_format($item->Price * $item->Quantity) ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <td colspan="5">Tổng tiền:</td>
                    <td class="font-weight-bold">
                        <?= number_format($total) ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>