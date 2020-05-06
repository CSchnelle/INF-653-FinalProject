<?php include 'view/header-admin.php'; ?>
<main>
    <h2>Author List</h2>
    <section>
        <?php if ( sizeof($authors) != 0) { ?>
            <table>
                <tr>
                    <th colspan="2">Name</th>
                </tr>        
                <?php foreach ($authors as $author) : ?>
                <tr>
                    <td><?php echo $author['authorName']; ?></td>
                    <td>
                        <form action="qd-admin.php" method="post">
                            <input type="hidden" name="action" value="delete_author">
                            <input type="hidden" name="authorID"
                                value="<?php echo $author['authorID']; ?>"/>
                            <input type="submit" value="Remove" class="button red" />
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>    
            </table>
        <?php } else { ?>
            <p>
                There are no authors in your database.
            </p>
        <?php } ?>
    </section>
    <section>
        <h2>Add Author</h2>
        <form action="qd-admin.php" method="post" id="add_author_form">
            <input type="hidden" name="action" value="add_author">

            <label>Author:</label>
            <input type="text" name="authorName" max="20" required><br>

            <label id="blankLabel">&nbsp;</label>
            <input id="add_author_button" type="submit" class="button blue" value="Add Author"><br>
        </form>
    </section>
    <section class="qdlinks">
        <p><a href="qd-admin.php">Back to Admin Quote List</a></p>
        <p><a href="qd-admin.php?action=show_add_form">Add a quote to database</a></p>
        <p><a href="qd-admin.php?action=list_authors">View/Edit Authors</a></p>
    </section>
</main>
