<?php

class Database{
    private static $dbPath = "C:\\Users\\philipmathewbobis\\OneDrive\\Documents\\Simple Log-In\\database\\database.db";
    private static $pdo = null;


    public static function connectDatabase(){
        if (self::$pdo === null){
            self::$pdo = new PDO('sqlite:' . self::$dbPath);
        }
    }
    
    public static function register(Account $account){
        self::connectDatabase();
        $sqlQuery = "INSERT INTO accounts (userId,name,username,password) VALUES (:userId,:name,:username,:password)";
        $statement = self::$pdo->prepare($sqlQuery);

        // Bind the values directly to the query without referencing
        $statement->bindValue(':userId',$account->getUserId());
        $statement->bindValue(':name',$account->getName());
        $statement->bindValue(':username',$account->getUsername());
        $statement->bindValue(':password',$account->getPassword());
        
        // Execute the statement
        if ($statement->execute()){
        echo "Account created successfully";
        }else {
        echo "Account not created successfully";    
        }
    }

    // Read All records from the accounts table
    public static function readAllRecords(){
        self::connectDatabase();
        $sql = "SELECT * FROM accounts";
        $statement = self::$pdo->prepare($sql);
        // Initialize accounts array
        $accounts = [];
        // Check if the query execute successfully
        if ($statement->execute()){
            // While the are rows returned or read in the database it will be true always
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                // Fetch all records as an associative array and store them in the $rows array
                array_push($accounts, new Account($row["name"],$row["username"],$row["password"])); // append the value to the end of the array
            }
            return $accounts; // return the whole array of records
        }else {
            echo "Failed to read all records";
        }
    }
}