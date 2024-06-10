<?php
require '../connection.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$sql = "SELECT p.*, pt.Name as ProductType FROM products p INNER JOIN producttypes pt ON p.ProductTypeId = pt.Id WHERE p.Id=:Id";
$params = ["Id" => $_GET['id']];
$result = ExecuteSelectQuery($sql, $params);
if (count($result) == 0) {
    header("Location: index.php");
} else {
    $product = $result[0];
}

$sql = "SELECT * FROM producttypes";
$productTypes = ExecuteSelectQuery($sql);

if (isset($_POST['SKU'])) {
    $sql = "UPDATE products
            SET SKU=:SKU, Name=:Name, Description=:Description, Price=:Price, Stock=:Stock, ProductTypeId=:ProductTypeId, Image='', Status=:Status
            WHERE Id=:Id";
    $params = [...$_POST, "Status" => isset($_POST['Status']) ? 1 : 0, "Id" => $_GET['id']];
    $result = ExecuteNonQuery($sql, $params);
    if ($result->rowCount() == 1) {
        header("Location: index.php");
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
    <title>Sửa sản phẩm</title>
</head>

<body>
    <div class="container">
        <h1>Sửa sản phẩm</h1>

        <form method="post">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="sku">Mã số</label>
                    <input id="sku" class="form-control" type="text" name="SKU" value="<?= $product->SKU ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="name">Tên sản phẩm</label>
                    <input id="name" class="form-control" type="text" name="Name" value="<?= $product->Name ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="description">Tác giả</label>
                    <input id="description" class="form-control" type="text" name="Description"
                        value="<?= $product->Description ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="productTypeId">Loại sách:</label>
                    <select id="productTypeId" class="custom-select" name="ProductTypeId">
                        <?php
                        foreach ($productTypes as $item) {
                            ?>
                            <option value="<?= $item->Id ?>" <?php if ($product->ProductTypeId == $item->Id)
                                  echo "selected" ?>>
                                <?= $item->Name ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="price">Giá bán (VNĐ)</label>
                    <input id="price" class="form-control" type="text" name="Price" value="<?= $product->Price ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="stock">Số lượng tồn kho</label>
                    <input id="stock" class="form-control" type="number" name="Stock" value="<?= $product->Stock ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="status">Trạng thái</label>
                    <div class="custom-control custom-switch">
                        <input id="status" class="custom-control-input" type="checkbox" name="Status" value="true" <?php if ($product->Status)
                            echo "checked"; ?>>
                        <label for="status" class="custom-control-label">Còn kinh doanh</label>
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <button class="btn btn-warning">
                    <i class="fa fa-check" aria-hidden="true"></i> Sửa
                </button>
                <button class="btn btn-danger" type="reset">
                    <i class="fa fa-times" aria-hidden="true"></i> Hủy bỏ
                </button>
            </div>
            <div>
                <a href="index.php">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Danh sách sản phẩm
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>