<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Document</title>
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
 
 
  }

    .error-message {
        color: red;
         font-family: 'Courier New', Courier, monospace;
        margin-top: 10px;
        border-radius: 40px;
        width:50%;
       margin-left: 200px;
       background-color: white;
       text-align: center;

    }
  </style>
<body>
 

 <?php include_once('navbar.php'); ?>
<div class="container border rounded p-4">


<h1 class="text-center">Login</h1>
<form action="login.php" method="POST">

  <div class="mb-3">
    <label for="firstname" class="form-label">Username</label>
    <input type="firstname" class="form-control" name="username"  placeholder="Enter username">
   </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>


  

  <div class="form-input btn rounded">
                <input type="submit" name="login" value="login" class="btn rounded border button ">
            </div>
</form>
</div>
</body>
</html>
<?php
if (isset($_POST['login'])) {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    include_once('db-connect.php');

    // Query
    $sql = "SELECT * FROM users WHERE username='$username'";

    // Execute the query
    $result = $database_connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPasswordFromDB = $row['password'];


        // Verifying
        if (password_verify($password, $hashedPasswordFromDB)) {
           

            $_SESSION['username'] = $username;
              $_SESSION['role'] = $row['role'];

              if ($_SESSION['role'] == 'admin') {
                header('Location: dashboard.php?id=admin');
            } else {
                header('Location: userDashboard.php?id=user');
            }
            
            exit(); 
        } else {
            
            echo "<div class='error-message'>Invalid credentials";
        }
  
}
}
?>
