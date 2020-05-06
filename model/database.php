<?php
    //local development server connection
   // $dsn = 'mysql:host=localhost;dbname=quotes';
   // $username = 'root';
    //$password = 'pa55word';

    // Heroku connection
    $dsn = 'mysql://zvwj921x0g9kku90:o9wefx7cc59ztm8m@wp433upk59nnhpoh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/ep1wrphu9699pdl3
;dbname=ep1wrphu9699pdl3';
    $username = 'zvwj921x0g9kku90';
    $password = 'o9wefx7cc59ztm8m';
   
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
