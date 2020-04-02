<?php
session_start();

include '../database/db.php'; //database connection

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, strtolower($_POST['email']));
    $password = mysqli_real_escape_string($connection, strtolower($_POST['password']));

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {  //checking if user do not exist
        header("Location: ../login.php?login=error");
        exit();
    }else {
        if ($row = mysqli_fetch_assoc($result)) { //fetching from the data database
            //de hashing the password
            $hashed = password_verify($password, $row['password']);
            if ($hashed === false) {
                header("Location: ../login.php?login=error");
                exit();
            }elseif ($hashed === true) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                //$_COOKIE['username'] = $row['Username'];
                header("Location: ../index.php");
                exit();
            }
        }
    }
}else {
    header("Location: ../login.php");
    exit();
}

