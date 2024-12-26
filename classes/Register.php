<?php
include_once "../classes.php";

$fullName;
$username;
$password;
$confirmPassword;

if (isset($_POST["name"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm-password"])){
    $fullName = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    if ($password !== $confirmPassword){
        header("Location:http://localhost:8000/Flowbite%20Designs/SignUp.php?error=password_mismatch");
        exit();
    }else if (Validation::validateUsername($username)){
        header("Location:http://localhost:8000/Flowbite%20Designs/SignUp.php?error=username_already_taken");
        exit();
    }

    $account = new Account($fullName,$username,$password);

    // When accessing static methods or variables Class name along with :: with method name or variable name
    Database::register($account);

    header("Location: http://localhost:8000/Flowbite%20Designs/login.php");
    exit();
}

?>