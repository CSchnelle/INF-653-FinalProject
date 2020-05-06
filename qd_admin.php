<?php
    require('model/database.php');
    require('model/quotes_db.php');
    require('model/author_db.php');
    require('model/categories_db.php');
    require('model/admin.php');

    //require_once('util/secure_conn.php');
    //require_once('util/valid_admin.php');
    
    session_start();
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'list_quotes';
        }
    }

    if ($action == 'list_quotes') {
        $author_id = filter_input(INPUT_GET, 'author_id', FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        $quote_id = filter_input(INPUT_GET, 'quote_id', FILTER_VALIDATE_INT);

        //show selected options in menu
        $category_name = get_category_name($category_id);
        $author_name = get_author_name($author_id);

        $quotes = get_all_quotes($sort);
        // apply quote filter 
        if ($quote_id != NULL && $quote_id != FALSE) {
            $quotes = array_filter($quotes, function($array) use ($quote_id) {
                return $array["quote"] == $quote_id;
            });
        }
        // apply author filter
        if ($author_id != NULL && $author_id != FALSE) {
            $quotes = array_filter($quotes, function($array) use ($author_name) {
                return $array["authorName"] == $author_name;
            });
        }
        // apply category filter 
        if ($category_id != NULL && $category_id != FALSE) {
            $quotes = array_filter($quotes, function($array) use ($category_name) {
                return $array["categoryName"] == $category_name;
            });
        }
  
        // use in drop menus 
        $authors = get_authors();
        $categories = get_categories();
        $quotes = get_quotes();
        include('qd_quote_list.php');
        include('view/footer.php');
    } else if ($action == 'list_authors') {
        $authors = get_authors();
        include('author_list.php');
        include('view/footer.php');
    } else if ($action == 'list_categories') {
        $categories = get_categories();
        include('category_list.php');
        include('view/footer.php');
    } else if ($action == 'delete_quote') {
        $quote_id = filter_input(INPUT_POST, 'quote_id', FILTER_VALIDATE_INT);
        if ($quote_id == NULL || $quote_id == FALSE) {
            $error = "Missing or incorrect quote id.";
            include('errors/error.php');
        } else {
            delete_quote($quote_id);
            header("Location: header-admin.php"); 
        }
    } else if ($action == 'delete_author') {
        $author_id = filter_input(INPUT_POST, 'author_id', FILTER_VALIDATE_INT);
        if ($author_id == NULL || $author_id == FALSE) {
            $error = "Missing or incorrect author id.";
            include('errors/error.php');
        } else {
            delete_author($author_id);
            header("Location: header-admin.php?action=list_authors");
        }
    } else if ($action == 'delete_category') {
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        if ($category_id == NULL || $category_id == FALSE) {
            $error = "Missing or incorrect category id.";
            include('errors/error.php');
        } else {
            delete_category($category_id);
            header("Location: header-admin.php?action=list_categories");
        }
    } else if ($action == 'show_add_form') {
        $categories = get_categories();
        $authors = get_authors();
        include('add_quote_form.php');
        include('view/footer.php');
    } else if ($action == 'add_quote') {
        $author_id = filter_input(INPUT_POST, 'author_id', FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $quote = filter_input(INPUT_POST, 'quote');
        $categoryName = filter_input(INPUT_POST, 'categoryName');
        $authorName = filter_input(INPUT_POST, 'authorName');
        if ($author_id == NULL || $author_id == FALSE || $category_id == NULL || $category_id == FALSE || $quote == NULL || $authorName == NULL || $categoryName == NULL ) {
            $error = "Invalid data. Check all fields and try again.";
            include('errors/error.php');
        } else {
            add_quote($author_id, $category_id, $quote, $authorName, $categoryName);
            header("Location: header-admin.php");
        }
    } else if ($action == 'add_author') {
        $author_name = filter_input(INPUT_POST, 'author_name');
        add_author($author_name);
        header("Location: qd-admin.php?action=list_authors");
    } else if ($action == 'add_category') {
        $category_name = filter_input(INPUT_POST, 'category_name');
        add_category($category_name);
        header("Location: header-admin.php?action=list_categories");
    }
?> 
