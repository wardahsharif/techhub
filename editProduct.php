<?php
$database_connection = mysqli_connect('localhost', 'root', '', 'php-project');

if ($database_connection->connect_error) {
    die("Connection failed: " . $database_connection->connect_error);
}

$product = [];

if (isset($_GET['productid'])) {
    $productid = $_GET['productid'];

    $sql = "SELECT * FROM products WHERE id = $productid";
    $result = $database_connection->query($sql);

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found");
    }
} else {
    die("Productid parameter not set");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $updateSql = "UPDATE products SET product_name = '$product_name', price = '$price', description = '$description' WHERE id = $productid";
    $updateResult = $database_connection->query($updateSql);

    if ($updateResult) {
        echo "Product updated successfully!";
        header("Location: dashboard.php?id=products");
        exit();
    } else {
        echo "Error updating product: " . $database_connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Edit Product</title>
</head>
<style>
    body {
        background-color: rgba(113, 117, 184, 0.945);
    }

    .container {
        background-color: white;
        margin-top: 150px;
    }

    h1 {
        font-family: 'Courier New', Courier, monospace;
        font-weight: bold;
    }

    label {
        font-family: 'Courier New', Courier, monospace;
    }

    .button {
        font-family: 'Courier New', Courier, monospace;
        background-color: rgba(191, 193, 225, 0.945);
        padding: 10px;
        margin: 0 auto;
        margin-top: 20px;
    }

    label {
        font-family: 'Courier New', Courier, monospace;
    }

    .back-button {
        padding: 15px;
        padding-left: 30px;
        padding-right: 30px;
        border: none;
    }

    .back-button:hover {
        padding: 15px;
        padding-left: 30px;
        padding-right: 30px;
        border: none;
        color: white;
        background-color: rgba(181, 187, 215, 0.845);
    }
</style>
<body>

<div class="container border rounded p-4">
    <h1 class="text-center">Edit Product</h1>

    <form action="edit_product.php?productid=<?php echo $productid; ?>" method="POST">
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name" value="<?php echo isset($product['product_name']) ? $product['product_name'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" name="price" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>" required>
        </div>

   <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" required><?php echo isset($product['description']) ? $product['description'] : ''; ?></textarea>
        </div>

        <div class="form-input btn rounded">
            <input type="submit" name="update" value="Update" class="btn rounded border button">
        </div>
    </form>
</div>

<div class="form-input btn rounded d-flex justify-content-center">
    <a href="dashboard.php?id=products">
        <input type="submit" name="back" value="Back" class="btn rounded border button back-button">
    </a>
</div>

</body>
</html>