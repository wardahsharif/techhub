<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>



        table{
            width: 90%;
            margin-top: 100px;
         margin-left: auto;
    margin-right: auto;
    overflow-x: auto;
        
        }

        th {
    font-family: serif;
}

    td {
    font-family: monospace;
  }

        tr, td, th{
            border: 1px solid grey;
            padding:10px;
          
   
        }

          button {
            font-family: 'Courier New', Courier, monospace;
            background-color: rgba(191, 193, 225, 0.945);
            padding: 10px;
            margin: 0 auto;
            border: none;
            box-shadow: 1px 1px 2px;
            border-radius: 5px;
            display: block;
            margin-bottom: 20px;
           padding-left:20px;
            padding-right:20px;
            }

              a {
    color: black;
    text-decoration: none;
  }

  a:hover {
   color: grey;
    text-decoration: none;
  }
    </style>
</head>
<body>
 
</body>
</html>


 <form action="delete.php" method="post">
<?php
$database_connection = mysqli_connect('localhost', 'root', '', 'php-project');

// var_dump($database_connection);

if ($database_connection->connect_error) {
    echo $database_connection->connect_error;
}

$sql = "SELECT * FROM products";

$result = $database_connection->query($sql);

echo 

"
 <table> 
    <tr>

        <th>ID</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>description</th>
       
    </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . $row['id']. " </td>
        <td>" . $row['product_name']. "</td>
        <td>" . $row['price']. "</td>
        <td>" . $row['description']. "</td>


        
     
    </tr>
    ";
   
}

echo "</table>";
?>

    </form>
