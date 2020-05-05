<?php
    require('model/database.php');
    require('model/categories_db.php');
    require('model/author_db.php');
    require('model/quotes_db.php');

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'list_quotes';
        }
    } else {
        
        $action = 'list_quotes';
    }

    if ($action == 'list_quotes') {
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        $category_name = filter_input(INPUT_GET, 'category');
        $sort = filter_input(INPUT_GET, 'sort');

        
        $sort = ($sort == "year") ? "year" : "price";

        $category_name = get_category_name($category_id);

        $quotes = get_all_quotes($sort);
        // apply make filter 
        if ($author_name != NULL && $author_name != FALSE) {
            $quotes = array_filter($quotes, function($array) use ($author_name) {
                return $array["author"] == $author_name;
            });
        }
        // apply type filter
        if ($category_id != NULL && $category_id != FALSE) {
            $quotes = array_filter($quotes, function($array) use ($category_name) {
                return $array["categoryName"] == $category_name;
            });
        }

        // use in drop menus 
        $categories = get_categories();
        $authors= get_authors();
        include('view/header.php');
        include('quote_list.php');
        include('view/footer.php');
    }
?> 
