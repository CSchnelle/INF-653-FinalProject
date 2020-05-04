<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $first = trim(filter_input(INPUT_GET, 'first'));
    $last = trim(filter_input(INPUT_GET, 'last'));

    $data = array("first"=>$first, "last"=>$last);
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

        $first = trim(filter_input(INPUT_POST, 'first'));
        $last = trim(filter_input(INPUT_POST, 'last'));

        $data = array("first"=>$first, "last"=>$last);
        header('Content-Type: application/json');
        echo json_encode($data);
    } 
} else {
    $data = array("message"=>"You did not send a GET or POST request");
    header('Content-Type: application/json');
    echo json_encode($data);
}
?>