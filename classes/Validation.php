<?php
include_once "../classes.php";

class Validation{


    public static function validateUsername($username){
        $db = new Database();
        $accounts = $db->readAllRecords();

        foreach($accounts as $account){
            if ($account->getUsername() === $username){
                return false;
            }else {
                return true;
            }
        }
    }

    public static function validateLogIn($username,$password){
        $accounts = Database::readAllRecords();
        foreach($accounts as $account){
            if ($account->getUsername() === $username && $account->getPassword() === $password){
                return true;
            }else{
                return false;
            }
        }
    }
}