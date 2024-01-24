<?php
//DB connection
$database_connection = mysqli_connect('localhost', 'root', '', 'php-project');

if ($database_connection->connect_error) {
    die("Connection failed: " . $database_connection->connect_error);
}


//fetch data
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $database_connection->query($sql);

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found");
    }
} else {
    die("Product ID parameter not set");
}

//delete product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $deleteSql = "DELETE FROM products WHERE id = $product_id";
    $deleteResult = $database_connection->query($deleteSql);

    if ($deleteResult) {
        echo "Product deleted successfully!";
        header("Location: dashboard.php?id=products");
        exit();
    } else {
        echo "Error deleting product: " . $database_connection->error;
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

    <style>

  body {
    background-color:rgba(113, 117, 184, 0.945);
  }
              a {
    color: red;
    text-decoration: none;
  }

  a:hover {
   color: black;
    text-decoration: none;
  }



.confirmation {
    font-size: 20px;
    border: solid 0px;
    border-radius: 10px;
    width: 80%;
    margin: 100px auto; 
    padding: 20px;
    text-align: center;
    background-color: white;
    font-family:  'Courier New', Courier, monospace;
}

.confirmation p {
    margin: 10px 0;
}

.confirmation button {
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-delete {
     background-color: rgba(191, 193, 225, 0.945);
}



    </style>
   
</head>

<body>

<div class="container border rounded p-4 confirmation">
    <h1 class="text-center">Confirm Delete</h1>
    <div class="confirmation">
        <p>Are you sure you want to delete the following product?</p>
        <p>ID: <?php echo $product['id']; ?></p>
        <p>Product Name: <?php echo $product['product_name']; ?></p>
        <p>Price: <?php echo $product['price']; ?></p>
        <p>Description: <?php echo $product['description']; ?></p>
    </div>
    <form action="confirmdelete-product.php?id=<?php echo $product_id; ?>" method="POST">
        <div class="form-input btn rounded btn-delete">
     <a href='deleteProduct.php?id=<?php echo $product_id; ?>'>Yes, Delete</a> | <a href='dashboard.php?id=products'>No, Cancel</a></div>
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
