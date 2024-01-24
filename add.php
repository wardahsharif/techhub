<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Add Product</title>
</head>
<style>
  body {
    background-color:rgba(113, 117, 184, 0.945);
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
  padding:15px;
  padding-left: 30px;
   padding-right: 30px;
   border: none;
  }

  a {
    color: black;
    text-decoration: none;
  }

    .back-button:hover {
  padding:15px;
  padding-left: 30px;
   padding-right: 30px;
   border: none;
   color:white;
    background-color: rgba(181, 187, 215, 0.845);
  }
</style>
<body>
<div class="container border rounded p-4">
    <h1 class="text-center">Add Product</h1>
    <form action="add.php?id=productid " method="POST"> <!-- Update action to the correct PHP file -->
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name" placeholder="Enter product name" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" name="price" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
        </div>

        <div class="form-input btn rounded">
            <input type="submit" name="add" value="Add" class="btn rounded border button px-4">
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



<?php

//db connection
include_once('db-connect.php');

//handling the form
if (isset($_POST['add'])) {
   
  //retrieving data
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];


    //input validation
    if (empty($product_name) || empty($price) || empty($description)) {
        echo "Please fill in all fields.";
        exit();
    }

    //insert data in DB
    $insertQuery = "INSERT INTO products (product_name, price, description) VALUES ('$product_name', '$price', '$description')";


    //excecute query
    if ($database_connection->query($insertQuery) === TRUE) {
        echo "Product added successfully!";
       

        header("Location: dashboard.php?id=products");
        exit();
    } else {
        echo "Error adding product: " . $database_connection->error;
    }
}
?>
