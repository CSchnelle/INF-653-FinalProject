<?php include 'util/valid_admin.php'; ?>
<main>
    <nav>
        <form action="qd-admin.php" method="get" id="author_selection">
            <!-- uses ternary if statements to determine selected or not -->
            <section id="dropmenus">
                <?php if ( sizeof($authors) != 0) { ?>
                    <label>Author:</label>
                    <select name="author">
                        <option value="0">View All Authors</option>
                        <?php foreach ($authors as $author) : ?>
                            <option value="<?php echo $author['author']; ?>" <?php echo ($authorName == $author['author'] ? "selected" : false)?>>
                                <?php echo $author['author']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>

                <?php if ( sizeof($categories) != 0) { ?>
                    <label>Categories:</label>
                    <select name="categoryID">
                        <option value="0">View All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['categoryID']; ?>" <?php echo ($categoryName == $category['categoryName'] ? "selected" : false)?>>
                                <?php echo $category['categoryName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>
            </section>
        </form>
    </nav>
    <section>
        <?php if( sizeof($quotes) != 0 ) { ?>
            <div id="table-overflow">
                <table>
                    <thead>
                        <tr>
                            <th>Quote:</th>
                            <th>Category:</th>
                            <th>Author:</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quotes as $quote) : ?>
                        <tr>
                            <td><?php echo $quote['category']; ?></td>
                            <td><?php echo $quote['author']; ?></td>
                            <?php if ($quote['categoryName'] == null || $quote['categoryName'] == false) { ?>
                                <td>None</td>
                            <?php } else { ?>
                                <td><?php echo $quote['categoryName']; ?></td>
                            <?php } ?>
                            <?php if ($quote['authorName'] == null || $quote['authorName'] == false) { ?>
                                <td>None</td>
                            <?php } else { ?>
                                <td><?php echo $quote['authorName']; ?></td>
                            <?php } ?>
                            <td>
                                <form action="qd-admin.php" method="post">
                                    <input type="hidden" name="action" value="delete_quote">
                                    <input type="hidden" name="quoteID"
                                        value="<?php echo $quote['quoteID']; ?>">
                                    <input type="submit" value="Remove" class="button red">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>  
        <?php } else { ?>
            <p>
                There are no matching quotes in Quotes&apos;s Database 
            </p>     
        <?php } ?>
    </section>
</main>
<script defer src="view/js/main.js" type="text/javascript"></script>
