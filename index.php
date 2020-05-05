<?php include 'view/header-admin.php'; ?>
<main>
    <nav>
        <form action="zua-admin.php" method="get" id="make_selection">
            <section id="dropmenus">
                <?php if ( sizeof($categories) != 0) { ?>
                    
                    <label>Category:</label>
                    <select name="category">
                        <option value="0">View All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['category']; ?>">
                                <?php echo $category['category']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>

                <?php if ( sizeof($authors) != 0) { ?>
                    <label>Authors:</label>
                    <select name="author_id">
                        <option value="0">View All Authors</option>
                        <?php foreach ($authors as $author) : ?>
                            <option value="<?php echo $author['authorID']; ?>">
                                <?php echo $author['authorName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>

                    </select> 
                    
                <?php } ?>
            </section>
            <section id="sortBy">
                <div>
                    <span>Sort by: </span>
                    <input type="radio" id="sortByCategory" name="sort" value="category" checked>
                    <label for="sortByCategory">Category</label> 
                    <input type="radio" id="sortByAuthor" name="sort" value="author">
                    <label for="sortByAuthor">Author</label>
                    <input type="submit" value="Submit Search" class="button blue button-slim">
                </div>
            </section>
        </form>
    </nav>
    <?php include 'view/zippy-links.php'; ?>
</main>