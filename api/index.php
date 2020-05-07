<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once'./model/database.php';
include_once './mode/quote_db.php';

global $db;

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $authorID = trim(filter_input(INPUT_GET, 'authorID'));
    $categoryID = trim(filter_input(INPUT_GET, 'categoryID'));
    $quotes = get_quotes($authorID, $categoryID);
    header('Content-Type: application/json');
    echo json_encode($quotes);

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SERVER["CONTENT_TYPE"])) {

        $data = array("message"=>"Required: Content-Type header");
        header('Content-Type: application/json');
        echo json_encode($data);

    } else if ($_SERVER["CONTENT_TYPE"] == "application/json") {

        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $categoryID = htmlspecialchars(strip_tags($data->categoryID));
        $authorID = htmlspecialchars(strip_tags($data->authorID));
        $quotes = htmlspecialchars(strip_tags($data->quoteText));
        header('Content-Type: application/json');
        echo json_encode($data);

    } else {

        $authorID = trim(filter_input(INPUT_POST, 'authorID'));
        $categoryID = trim(filter_input(INPUT_POST, 'categoryID'));

        $data = array("authorID"=>$authorID, "categoryID"=>$categoryID);
        header('Content-Type: application/json');
        echo json_encode($data);
    } 
} else {
    $data = array("message"=>"You did not send a GET or POST request");
    header('Content-Type: application/json');
    echo json_encode($data);
}
?>
