<?php
    //session_start();
    //require_once('util/secure_conn.php');
    //require_once('util/valid_admin.php');
    require('model/database.php'); 
    require('model/quotes_db.php');
    require('model/author_db.php');
    require('model/categories_db.php');
 

    
    $action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_quotes';

    switch ($action) {
        case 'list_quotes':
            $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
            $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
            $authorName = filter_input(INPUT_GET, 'authorName');
            $categoryName = filter_input(INPUT_GET, 'categoryName');
            $sort = filter_input(INPUT_GET, 'sort');

            $categoryName = get_category_name($categoryID);
            $authorName = get_author_name($authorID);

            $quotes = get_all_quotes($sort);
     
            if (!empty($authorID)) {
                $quotes = array_filter($quotes, function($array) use ($authorName) {
                    return $array["authorName"] == $authorName;
                });
            }
        
            if (!empty($categoryID)) {
                $quotes = array_filter($quotes, function($array) use ($categoryName) {
                    return $array["categoryName"] == $categoryName;
                });
            }
         

            // use in drop menus 
            $authors = get_authors();
            $categories = get_categories();
            $quotes = get_quotes();
            include('view/header-admin.php');
            include('zua_quote_list.php');
            include('view/footer.php');
            break;
        case 'list_authors':
            $types = get_authors();
            include('view/header-admin.php');
            include('author_list.php');
            include('view/footer.php');
            break;
        case 'list_categories':
            $classes = get_categories();
            include('view/header-admin.php');
            include('category_list.php');
            include('view/footer.php');
            break;
        case 'delete_quote':
            $quoteID = filter_input(INPUT_POST, 'quoteID', FILTER_VALIDATE_INT);
            if (empty($quoteID)) {
                $error = "Missing or incorrect quote id.";
                include('view/header-admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                delete_quote($quoteID);
                header("Location: qd-admin.php"); 
            }
            break;
        case 'delete_author':
            $authorID = filter_input(INPUT_POST, 'authorID', FILTER_VALIDATE_INT);
            if (empty($authorID)) {
                $error = "Missing or incorrect author id.";
                include('view/header-admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                delete_author($authorID);
                header("Location: qd-admin.php?action=list_authors");
            }
            break;
        case 'delete_category':
            $categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
            if (empty($categoryID)) {
                $error = "Missing or incorrect category id.";
                include('view/header-admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                delete_category($categoryID);
                header("Location: qd-admin.php?action=list_categories");
            }
            break;
        case 'show_add_form':
            $classes = get_categories();
            $types = get_authors();
            include('view/header-admin.php');
            include('add_quote_form.php');
            include('view/footer.php');
            break;
        case 'add_quote':
            $authorID = filter_input(INPUT_POST, 'authorID', FILTER_VALIDATE_INT);
            $categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
            $quoteID = filter_input(INPUT_POST, 'quoteID');
            if (empty($authorID) || empty($categoryID) || empty($quoteID)) {
                $error = "Invalid quote data. Check all fields and try again.";
                include('view/header-admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                add_quote($authorID, $categoryID, $quoteID);
                header("Location: qd-admin.php");
            }
            break;
        case 'add_author':
            $authorName = filter_input(INPUT_POST, 'authorName');
            add_author($authorName);
            header("Location: qd-admin.php?action=list_authors");
            break;
        case 'add_category':
            $categoryName = filter_input(INPUT_POST, 'categoryName');
            add_category($categoryName);
            header("Location: qd-admin.php?action=list_categories");
            break;
        case 'logout':
            $_SESSION = array();    //Clear all session data from memory
            session_destroy();      //Clean up the session ID
            header("Location: qd-login.php");
    }
?> 
