<?php

//DB connection
include_once('db-connect.php'); 

//check user id in url
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];


    //check if user exists
    $checkUserQuery = "SELECT * FROM users WHERE id = $user_id";
    $result = $database_connection->query($checkUserQuery);

    if ($result->num_rows > 0) {
        

     //delete user
        $deleteQuery = "DELETE FROM users WHERE id = $user_id";

        if ($database_connection->query($deleteQuery) === TRUE) {
            echo "User deleted successfully!";
        } else {
            echo "Error deleting user: " . $database_connection->error;
        }
    } else {
        echo "Error: User not found.";
    }

  
    header("Location:dashboard.php?id=users");
    exit();
} else {
    echo "Error: User ID not provided.";
}
?>
