<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/LedgerReportModel.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$ledgerReport = new LedgerReportModel($db);

// Get raw posted data
//$data = json_decode(file_get_contents("php://input"));

// Set Required Variables
$ledgerReport->AC_NO = $_GET['AC_NO'];
$ledgerReport->FROM_DATE = $_GET['FROM_DATE'];
$ledgerReport->TO_DATE = $_GET['TO_DATE'];


// Category read query
$result = $ledgerReport->read();

// Get row count
$num = $result->rowCount();

// Check if any categories
if($num > 0) {
    // Cat array
    $cat_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $cat_item = array(
            'V_NO' => $V_NO,
            'V_DATE' => $V_DATE,
            'AC_NO' => $AC_NO,
            'AC_TITLE' => $AC_TITLE,
            'DESCRIPTION' => $DESCRIPTION,
            'DEBIT' => $DEBIT,
            'CREDIT' => $CREDIT,
            'OPENING_BALANCE' => $OPENING_BALANCE,
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
