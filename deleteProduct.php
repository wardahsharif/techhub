<?php


if (isset($_GET['id'])) {
    $product_id = $_GET['id'];


    $checkUserQuery = "SELECT * FROM products WHERE id = $product_id";
    $result = $database_connection->query($checkUserQuery);

    if ($result->num_rows > 0) {
      
        $deleteQuery = "DELETE FROM products WHERE id = $product_id";

        if ($database_connection->query($deleteQuery) === TRUE) {
            echo "product deleted successfully!";
        } else {
            echo "Error deleting product: " . $database_connection->error;
        }
    } else {
        echo "Error: product not found.";
    }

    header("Location:dashboard.php?id=products");
    exit();
} else {
    echo "Error: product ID not provided.";
}
?>
