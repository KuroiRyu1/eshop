<?php
require "../connection.php";

$sql = "SELECT * FROM producttypes";
$productTypes = ExecuteSelectQuery($sql);

if (isset($_POST["SKU"])) {
    $sql = "INSERT INTO products (SKU, Name, Description, Price, Stock, ProductTypeId, Image, Status)
            VALUES (:SKU, :Name, :Description, :Price, :Stock, :ProductTypeId, '', :Status)";
    $params = [...$_POST, "Status" => isset($_POST['Status']) ? 1 : 0];
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
    <title>Thêm sản phẩm</title>
</head>

<body>
    <div class="container">
        <h1>Thêm sản phẩm</h1>

        <form method="post">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="SKU">Mã số</label>
                    <input id="SKU" class="form-control" type="text" name="SKU">
                </div>
                <div class="form-group col-md-4">
                    <label for="Name">Tên sản phẩm</label>
                    <input id="Name" class="form-control" type="text" name="Name">
                </div>
                <div class="form-group col-md-4">
                    <label for="Description">Tác giả</label>
                    <input id="Description" class="form-control" type="text" name="Description">
                </div>
                <div class="form-group col-md-4">
                    <label for="ProductTypeId">Loại sách:</label>
                    <select id="ProductTypeId" class="custom-select" name="ProductTypeId">
                        <?php
                        foreach ($productTypes as $item) {
                            ?>
                            <option value="<?= $item->Id ?>"><?= $item->Name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="Price">Giá bán (VNĐ)</label>
                    <input id="Price" class="form-control" type="text" name="Price">
                </div>
                <div class="form-group col-md-2">
                    <label for="Stock">Số lượng tồn kho</label>
                    <input id="Stock" class="form-control" type="number" name="Stock">
                </div>
                <div class="form-group col-md-4">
                    <label for="Status">Trạng thái</label>
                    <div class="custom-control custom-switch">
                        <input id="Status" class="custom-control-input" type="checkbox" name="Status" value="true"
                            checked>
                        <label for="Status" class="custom-control-label">Còn kinh doanh</label>
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <button class="btn btn-success">
                    <i class="fa fa-plus" aria-hidden="true"></i> Thêm
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