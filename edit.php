<?php

//connection
$database_connection = mysqli_connect('localhost', 'root', '', 'php-project');

if ($database_connection->connect_error) {
    die("Connection failed: " . $database_connection->connect_error);
}


//fetching user data
$user = [];


if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];


    $sql = "SELECT * FROM users WHERE id = $userid";
    $result = $database_connection->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found");
    }
} else {
    die("Userid parameter not set");
}

//update user data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];


    //updates in DB
    $updateSql = "UPDATE users SET username = '$username', email = '$email', role = '$role' WHERE id = $userid";
    $updateResult = $database_connection->query($updateSql);

    //results of update
    if ($updateResult) {
        echo "User updated successfully!";
        header("Location: dashboard.php?id=users");
        exit();
    } else {
        echo "Error updating user: " . $database_connection->error;
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

    <title>Edit User</title>
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


<h1 class="text-center">Edit User</h1>

 <form action="edit.php?userid=<?php echo $userid; ?>" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="role">Role:</label>
            <select name="role" class="px-4 rounded">
                <option value="user" <?php echo (isset($user['role']) && $user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo (isset($user['role']) && $user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select><br>
        </div>

        <div class="form-input btn rounded">
            <input type="submit" name="update" value="Update" class="btn rounded border button">
        </div>
    </form>
</div>

  <div class="form-input btn rounded  d-flex justify-content-center">
              <a href="dashboard.php?id=users">  <input type="submit" name="back" value="Back" class="btn rounded border button back-button"></a>
            </div>
</body>
</html>


