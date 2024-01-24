<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Document</title>
    <style>

        nav{
            background-color: rgba(45, 48, 104, 0.945);
            padding: 14px 0px;
        }

        ul li{
            display: inline;
        }

        ul li a{
            text-decoration: none;
            color: white;
            padding: 0px 28px;
           font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            font-size: large;
        }

          .container {
       background-color: white;
       margin-top: 10px;
  }

  h1 {
    font-family: 'Courier New', Courier, monospace;
    font-weight: bold;
  }

    </style>
</head>
<body>
    <div>
        <!-- Navigation -->
        <nav>
            <ul class="text-center">
                <li><a href="dashboard.php?id=users">Manage Users</a></li>
                <li><a href="dashboard.php?id=products">Manage Products</a></li>
                <li><a href="dashboard.php?id=logout">Logout</a></li>
            </ul>
        </nav>

        <div class="container text-center"><h1>
                            <?php  echo "Welcome to your dashboard " . $_SESSION['username'];?>
        </h1></div>

        <!-- Main Section -->
        <main>
            <div>
                <?php
                  if(isset($_GET['id'])){
                    $selected_option = $_GET['id'];

                  switch ($selected_option) {
                    case 'users':
                            include_once 'users.php';
                        break;
                
                    case 'products':
                        include_once 'products.php';
                    break;
                     case 'edit':
                          include_once 'edit.php';
                         break;
                     case 'add':
                          include_once 'add.php';
                         break;

                    case 'logout':
                        session_destroy();
                        header('Location: login.php');
                    break;
                    default:
                     include_once  'dashboardHome.php';
                        break;
                  }
                  }
                ?>
            </div>
        </main>
    </div>
</body>
</html>