<?php
require "../connection.php";

$sql = "SELECT p.*, pt.Name as ProductType
        FROM products p INNER JOIN producttypes pt ON p.ProductTypeId = pt.Id
        WHERE p.Status = 1 AND Stock > 0
        ORDER BY p.Id ASC";
$products = ExecuteSelectQuery($sql);
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
    <title>Danh sách sản phẩm</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            foreach ($products as $item) {
                ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="../images/product/<?= $item->Image ?>" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item->Name ?></h5>
                            <p class="card-text"><?= $item->Description ?></p>
                        </div>
                        <div class="card-footer">
                            <form action="../carts/add.php" method="post">
                                <input type="hidden" name="id" value="<?= $item->Id ?>">
                                <button class="btn btn-success">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i> <?= number_format($item->Price) ?>
                                    VNĐ
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>