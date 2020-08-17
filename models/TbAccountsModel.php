<?php
class TbAccountsModel
{
    public $AC_CODE;
    public $AC_NAME;
    public $OP_DEBIT;
    public $OP_CREDIT;
    public $OP_DATE;
    public $ADDRESS;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }


    public function read() {
        // Create query
        $query = 'SELECT 
        AC_NO, AC_NAME, OP_DEBIT, OP_CREDIT, OP_DATE, ADDRESS
      FROM
        tbaccounts';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}