<?php
$database_connection = mysqli_connect('localhost', 'root', '', 'php-project');

// var_dump($database_connection);

if ($database_connection->connect_error) {
    echo $database_connection->connect_error;
}