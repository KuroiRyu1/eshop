<?php
require "../connection.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$sql = "SELECT p.*, pt.Name as ProductType FROM products p INNER JOIN producttypes pt ON p.ProductTypeId = pt.Id WHERE p.Id=:id";
$params = ["id" => $_GET['id']];
$result = ExecuteSelectQuery($sql, $params);
if (count($result) == 0) {
    header("Location: index.php");
}
$product = $result[0];
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
    <title><?= $product->Name ?></title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="../images/product/<?= $product->Image ?>" class="w-100">
            </div>
            <div class="col-md-9">
                <h1 class="text-justify"><?= $product->Name ?></h1>
                <h5 class="float-right">
                    <span class="font-weight-bold">Tác giả:</span>
                    <?= $product->Description ?>
                </h5>

                <table class="table table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>Mã số</th>
                            <th>Loại sách</th>
                            <th>Giá bán (VNĐ)</th>
                            <th>Tồn kho</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $product->SKU ?></td>
                            <td><?= $product->ProductType ?></td>
                            <td><?= number_format($product->Price) ?></td>
                            <td><?= $product->Stock ?></td>
                            <td>
                                <?php if ($product->Status) {
                                    ?>
                                    <p class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></p>
                                    <?php
                                } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb-2">
                    <a href="edit.php?id=<?= $product->Id ?>" class="btn btn-warning">
                        <i class="fa fa-pen" aria-hidden="true"></i> Sửa
                    </a>
                    <form action="delete.php" class="d-inline" method="post"
                        onsubmit="return confirm('Bạn có chắc muốn xóa cuốn sách:\n\n<?= $product->Name ?>');">
                        <input type="hidden" name="id" value="<?= $product->Id ?>">
                        <button class="btn btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                        </button>
                    </form>
                </div>
                <div>
                    <a href="index.php">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Danh sách sản phẩm
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>