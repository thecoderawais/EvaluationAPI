<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/UserLoginModel.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$user = new UserLoginModel($db);

// Get raw posted data
//$data = json_decode(file_get_contents("php://input"));

// Set Required Variables
$user->Code = $_GET['Code'];
$user->Username = $_GET['Username'];
$user->Password = $_GET['Password'];


// Category read query
$result = $user->login();

// Get row count
$num = $result->rowCount();

// Check if any categories
if($num > 0) {
    // Cat array
    $cat_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $cat_item = array(
            'Code' => $Code,
            'Username' => $Username,
            'Password' => $Password,
            'CompanyName' => $CompanyName,
            'OwnerName' => $OwnerName,
            'IsActive' => $IsActive
        );

        // Push to "data"
        array_push($cat_arr, $cat_item);
    }

    // Turn to JSON & output
    echo json_encode($cat_arr);

} else {
    // No Categories
    echo json_encode(
        array('message' => 'User does not exist!')
    );
}

?>