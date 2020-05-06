<main>
    <nav>
        <form action="." method="get" id="author_selection">
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
                    <label>Category:</label>
                    <select name="categoryID">
                        <option value="0">View All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['categoryID']; ?>" <?php echo ($categoryName == $category['categoryName'] ? "selected" : false)?>>
                                <?php echo $type['categoryName']; ?>
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
                            <th>Author</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quotes as $quote) : ?>
                        <tr>
                            <td><?php echo $quote['author']; ?></td>
                            <td><?php echo $quote['category']; ?></td>
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
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>  
        <?php } else { ?>
            <p>
                There are no matching quotes in Quotes&apos;s Database. 
            </p>     
        <?php } ?>
    </section>
</main>
<script defer src="view/js/main.js" type="text/javascript"></script>
