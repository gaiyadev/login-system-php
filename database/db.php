<?php

$host_name = "localhost";
$user_name = "root";
$password = "";
$database = "login_system";
//creatin connection

$connection = mysqli_connect($host_name, $user_name, $password, $database);

if (!$connection) {
    die("<strong>Error</strong>" . mysqli_connect_error());
}
