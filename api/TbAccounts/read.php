<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/TbAccountsModel.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$tbAccounts = new TbAccountsModel($db);

// Category read query
$result = $tbAccounts->read();

// Get row count
$num = $result->rowCount();

// Check if any categories
if($num > 0) {
    // Cat array
    $cat_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $cat_item = array(
            'AC_CODE' => $AC_CODE,
            'AC_NAME' => $AC_NAME,
            'OP_DEBIT' => $OP_DEBIT,
            'OP_CREDIT' => $OP_CREDIT,
            'OP_DATE' => $OP_DATE,
            'ADDRESS' => $ADDRESS,
        );

        // Push to "data"
        array_push($cat_arr, $cat_item);
    }

    // Turn to JSON & output
    echo json_encode($cat_arr);

} else {
    // No Categories
    echo json_encode(
        array('message' => 'No Records Found in Ledger')
    );
}
