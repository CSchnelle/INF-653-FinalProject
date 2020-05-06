<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $authorID = trim(filter_input(INPUT_GET, 'authorID'));
    $categoryID = trim(filter_input(INPUT_GET, 'categoryID'));

    $data = array("authorID"=>$authorID, "categoryID"=>$categoryID);
    header('Content-Type: application/json');
    echo json_encode($data);

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SERVER["CONTENT_TYPE"])) {

        $data = array("message"=>"Required: Content-Type header");
        header('Content-Type: application/json');
        echo json_encode($data);

    } else if ($_SERVER["CONTENT_TYPE"] == "application/json") {

        $json = file_get_contents('php://input');

        $data = json_decode($json);

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
