<?php
/**
 * Created by PhpStorm.
 * User: ranaa
 * Date: 28-Jul-2020
 * Time: 11:17 AM
 */

class LedgerReportModel
{
    public $V_NO ;
    public $V_DATE ;
    public $AC_NO ;
    public $AC_TITLE ;
    public $DESCRIPTION ;
    public $VDEBIT ;
    public $V_CREDIT ;
    public $OPENING_BALANCE;
    public $FROM_DATE;
    public $TO_DATE;
    public $Where_Clause;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }


    public function read() {
        // Create query
        $query = 'SELECT 
        V_DATE, V_NO, DESCRIPTION, VDEBIT, V_CREDIT,
        AC_CODE, AC_NAME
      FROM
        voudtl JOIN tbaccounts ON AC_NO = AC_CODE 
        WHERE AC_NO= :AC_NO AND V_DATE BETWEEN :FROM_DATE and :TO_DATE';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Bind Data
        $stmt-> bindParam(':AC_NO', $this->AC_NO);
        $stmt-> bindParam(':FROM_DATE', $this->FROM_DATE);
        $stmt-> bindParam(':TO_DATE', $this->TO_DATE);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    public function read_multiple($whereClause) {
        // Create query
        $query = 'SELECT 
        V_DATE, V_NO, DESCRIPTION, VDEBIT, V_CREDIT,
        AC_CODE, AC_NAME
      FROM
        voudtl JOIN tbaccounts ON AC_NO = AC_CODE ' . $whereClause;
//        WHERE AC_NO= :AC_NO AND V_DATE BETWEEN :FROM_DATE and :TO_DATE';


        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}