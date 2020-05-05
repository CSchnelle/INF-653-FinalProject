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

    function get_author_name($author_id) {
        global $db;
        $query = 'SELECT * FROM authors WHERE authorID = :author_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->execute();
        $author = $statement->fetch();
        $statement->closeCursor();
        $author_name = $class['authorName'];
        return $author_name;
    }

    function delete_author($author_id) {
        global $db;
        $query = 'DELETE FROM authors WHERE authorID = :author_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_author($author_name) {
        global $db;
        $query = 'INSERT INTO authors (authorName)
              VALUES
                 (:authorName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':authorName', $author_name);
        $statement->execute();
        $statement->closeCursor();
    }
?>