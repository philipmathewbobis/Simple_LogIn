<?php
 
class Account{
    private int $userId;
    private string $name;
    private string $username;
    private string $password;

    public function __construct(string $name,string $username,string $password){
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->userId = $this->generateId();
    } 

    public function getUserId():int{
        return $this->userId;
    }

    public function getUsername():string{
        return $this->username;
    }

    public function getPassword():string{
        return $this->password;
    }

    public function getName():string{
        return $this->name;
    }

    public function generateId(){
        return rand(1,200);
    }
}