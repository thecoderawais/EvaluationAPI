<?php
/**
 * Created by PhpStorm.
 * User: ranaa
 * Date: 16-Aug-2020
 * Time: 6:06 AM
 */

class UserLoginModel
{

    public $Code ;
    public $Username ;
    public $Password ;
    public $OwnerName ;
    public $IsActive ;
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }


    public function login() {
        // Create query
        $query = 'SELECT 
        *
      FROM
        users
        WHERE Code = :code and Username = :username and Password = :password';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind Data
        $stmt-> bindParam(':code', $this->Code);
        $stmt-> bindParam(':username', $this->Username);
        $stmt-> bindParam(':password', $this->Password);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}