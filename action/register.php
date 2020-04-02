<?php
include '../database/db.php'; //database connection
// initialzing error to emapty
$err_array = array('email_err'=> '', 'username_err' => '', 'email_err' => '', 'password_err' => '',
    'retype_password' => '');

if (isset($_POST['register'])) {
    // accepting the form input
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $retype_password = mysqli_real_escape_string($connection, $_POST['retype_password']);
//echo $password;
//die();
    if (empty($username) || empty($password) || empty($retype_password)) {
        header("Location: ../register.php");
        exit();
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $username) || !preg_match("/^[a-zA-Z]*$/", $password) || !preg_match("/^[a-zA-Z]*$/", $retype_password )) {
            header("Location: ../register.php");
            exit();
        } else {
            //checking for valid email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../register.php");
                exit();
            } else{
                if ($password !== $retype_password) {
                    header("Location: ../register.php");
                }else {
                    //checking if username already exist
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($connection, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        header("Location: ../register.php");
                        exit();
                    } else {
                        //hashing the password
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        //Inserting the user into the database
                        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword');";
                        mysqli_query($connection, $sql);
                        header("Location: ../login.php");
                        exit();
                    }
                }


            }
        }
    }


    } else{
    header("Location: ../register.php");
    die();
}
