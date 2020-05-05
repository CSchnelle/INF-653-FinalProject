<?php
    //local development server connection
   // $dsn = 'mysql:host=localhost;dbname=zippyusedautos';
   // $username = 'root';
    //$password = 'pa55word';

    // Heroku connection
    $dsn = 'mysql:host=zy4wtsaw3sjejnud.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=f33okin59mld7tzf';
    $username = 'hu0wlnc966uyzjy4';
    $password = 'cmtbdgfv39s2i8o1';
   
    try {
        //local development server connection
        //if using a $password, add it as 3rd parameter
        $db = new PDO($dsn, $username);

        // Heroku connection
        //$db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>