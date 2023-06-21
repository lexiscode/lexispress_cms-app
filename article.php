<?php

require "includes/init.php";
/*
require "classes/DbConnect.php";
require "classes/GetArticleId.php";
*/

// Connect to the Database Server
$conn = require "includes/db.php";

// This gets the id from the browser tab when the save button was clicked in the new article page
if (isset($_GET['id'])){

    // Reading from the database to get specific article row by their id
    $article = GetArticleId::getArticleById($conn, $_GET['id']); // this holds an data in object format
    
} else {
    // no error message printed when there's no id included in the url link
    $article = null; 
}
?>

<?php require "includes/header.php"; ?>

    <!--if the article contents anything other than false or null, then run as true-->
    <?php if ($article): ?>

        <article>
            <!--had to change from assoc array to obj format in order to tally with the getArticleById method-->
            <h2><?php echo htmlspecialchars($article->title) ?></h2> 

            <?php if ($article->image_file): ?>
                <img src="uploads/<?= $article->image_file; ?>" alt="">
            <?php endif; ?>

            <p><?php echo htmlspecialchars($article->content) ?></p>
            <p><?php echo $article->date_published?></p>
        </article>     
     
    <?php else: ?>
        <!--this runs when the article it is false or null-->
        <p>No articles found.</p>
    <?php endif; ?>

<?php require "includes/footer.php"; ?>


