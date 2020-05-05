<?php include 'view/header-admin.php'; ?>
<main>
    <h2>Category List</h2>
    <section>
        <?php if ( sizeof($categories) != 0) { ?>
            <table>
                <tr>
                    <th colspan="2">Name</th>
                </tr>        
                <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?php echo $category['categoryName']; ?></td>
                    <td>
                        <form action="qd-admin.php" method="post">
                            <input type="hidden" name="action" value="delete_category">
                            <input type="hidden" name="category_id"
                                value="<?php echo $type['categoryID']; ?>"/>
                            <input type="submit" value="Remove" class="button red" />
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>    
            </table>
        <?php } else { ?>
            <p>
                There are no categories in your database.
            </p>
        <?php } ?>
    </section>
    <section>
        <h2>Add Category</h2>
        <form action="qd-admin.php" method="post" id="add_category_form">
            <input type="hidden" name="action" value="add_category">

            <label>Category:</label>
            <input type="text" name="category_name" max="20" required><br>

            <label id="blankLabel">&nbsp;</label>
            <input id="add_type_button" type="submit" class="button blue" value="Add Type"><br>
        </form>
    </section>
    <section class="qdlinks">
        <p><a href="qd-admin.php">Back to Admin Quote List</a></p>
        <p><a href="qd-admin.php?action=show_add_form">Add a quote to database</a></p>
        <p><a href="qd-admin.php?action=list_authors">View/Edit Authors</a></p>
    </section>
</main>