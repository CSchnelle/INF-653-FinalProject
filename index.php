<?php
    require('model/database.php');
    require('model/quote_db.php');
    require('model/quthor_db.php');
    require('model/categories_db.php');


    $action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_quotes';

    switch ($action) {
        default: 
            $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
            $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
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
            $aurhors = get_authors();
            $categories = get_categories();
            $quotes = get_quotes();
            include('view/header.php');
            include('quote_list.php');
            include('view/footer.php');
    }
?> 
