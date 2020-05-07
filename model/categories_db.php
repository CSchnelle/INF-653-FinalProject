<?php 
    function get_categories() {
        global $db;
        $query = 'SELECT * FROM categories ORDER BY categoryName';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();
        return $categories;
    }

    function delete_category($categoryID) {
        global $db;
        $query = 'DELETE FROM categories WHERE categoryID = :categoryID';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryID', $categoryID);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_category($categoryName) {
        global $db;
        $query = 'INSERT INTO categories (categoryName)
              VALUES
                 (:categoryName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryName', $categoryName);
        $statement->execute();
        $statement->closeCursor();
    }
    
?>
