<?php
require "../connection.php";

$sql = "SELECT p.*, pt.Name as ProductType
        FROM products p INNER JOIN producttypes pt ON p.ProductTypeId = pt.Id
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
    <div class="container-fluid">
        <h1>Danh sách sản phẩm</h1>

        <a href="add.php" class="btn btn-success mb-2">
            <i class="fa fa-plus" aria-hidden="true"></i> Thêm
        </a>

        <table class="table table-light">
            <thead class="thead-dark">
                <tr>
                    <th>Hình ảnh</th>
                    <th>SKU</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th>Loại sách</th>
                    <th>Giá bán (VNĐ)</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products as $item) {
                    ?>
                    <tr>
                        <td>
                            <img src="../images/product/<?= $item->Image ?>" style="width: 50px;">
                        </td>
                        <td><?= $item->SKU ?></td>
                        <td><?= $item->Name ?></td>
                        <td><?= $item->Description ?></td>
                        <td><?= $item->ProductType ?></td>
                        <td><?= number_format($item->Price) ?></td>
                        <td><?= $item->Stock ?></td>
                        <td>
                            <?php if ($item->Status) {
                                ?>
                                <p class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
                                <?php
                            } else {
                                ?>
                                <p class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></p>
                                <?php
                            } ?>
                        </td>
                        <td>
                            <a href="details.php?id=<?= $item->Id ?>" class="btn btn-info">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </a>
                            <a href="edit.php?id=<?= $item->Id ?>" class="btn btn-warning">
                                <i class="fa fa-pen" aria-hidden="true"></i>
                            </a>
                            <form action="delete.php" class="d-inline" method="post"
                                onsubmit="return confirm('Bạn có chắc muốn xóa cuốn sách:\n\n<?= $item->Name ?>');">
                                <input type="hidden" name="Id" value="<?= $item->Id ?>">
                                <button class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
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