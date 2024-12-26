<?php
include "../classes.php";
session_start();

$username;
$password;

if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["username"])){
    if (Validation::validateLogIn($_POST["username"],$_POST["password"])){
        $accounts = Database::readAllRecords();
        foreach ($accounts as $account){
            if ($account->getUsername() === $_POST["username"] && $account->getPassword() === $_POST["password"]){
                // Check if the server client ip proxy is not empty
                if (!empty($_SERVER["HTTP_CLIENT_IP"])){
                    $clientIp = $_SERVER["HTTP_CLIENT_IP"]; // Used if the client is behind a proxy 
                // Check if the server client ip passed from through multiple proxies is not empty    
                }else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
                    $clientIp = $_SERVER["HTTP_X_FORWARDED_FOR"]; // contains a list of IP addresses if the request are passed through multiple proxies
                // Check if the server client direct ip is not empty    
                }else if (!empty($_SERVER["REMOTE_ADDR"])){
                    $clientIp = $_SERVER["REMOTE_ADDR"]; // The actual ip of client
                }
                $_SESSION["user_id"] = $account->getUserId();
                $_SESSION["username"] = $account->getUsername();
                $_SESSION["name"] = $account->getName();
                $_SESSION["user_ip"] = $clientIp; // store the ip of the client in the session
                $_SESSION["user_agent"] = $_SERVER["HTTP_USER_AGENT"]; // stores the users browser agent in session
               

                header("Location:../Flowbite%20Designs/Dashboard.php");
                exit();
            }
        }
    }else {
        header("Location:../Flowbite%20Designs/login.php?error=usernameorpassword_notmatch");
        exit();
    }
}