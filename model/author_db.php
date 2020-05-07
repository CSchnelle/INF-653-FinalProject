<?php 
    function get_authors() {
        global $db;
        $query = 'SELECT * FROM authors ORDER BY authorID';
        $statement = $db->prepare($query);
        $statement->execute();
        $authors = $statement->fetchAll();
        $statement->closeCursor();
        return $authors;
    }

    function delete_author($authorID) {
        global $db;
        $query = 'DELETE FROM authors WHERE authorID = :authorID';
        $statement = $db->prepare($query);
        $statement->bindValue(':authorID', $authorID);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_author($authorName) {
        global $db;
        $query = 'INSERT INTO authors (authorName)
              VALUES
                 (:authorName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':authorName', $authorName);
        $statement->execute();
        $statement->closeCursor();
    }
?>
