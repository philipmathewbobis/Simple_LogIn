<?php
session_start();

if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location:http://localhost:8000/Flowbite%20Designs/landingpage.php");
    exit();
}else {
    session_destroy();
    header("Location:../Flowbite%20Designs/landingpage.php");
    exit();
}