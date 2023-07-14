<?php

require "../includes/init.php";

/*require "../classes/DbConnect.php";
require "../classes/GetArticleId.php";*/


// in this case of the admin page, you must be login to access this page
Auth::requireLogin();

// Connect to the Database Server
$conn = require "../includes/db.php";

// This gets the id from the browser tab when the save button was clicked in the new article page
if (isset($_GET['id'])){

    /* Reading from the database to get specific article row by their id
    $article = GetArticleId::getArticleById($conn, $_GET['id']);  this holds an associative array*/

    // REPEAT: Reading from the database to get specific article row by their id
    $article = GetArticleId::getWithCategories($conn, $_GET['id']); // this holds an data in object format
    
} else {
    // no error message printed when there's no id included in the url link
    $article = null; 
}
?>

<?php require "../includes/header.php"; ?>

    <!--if the article contents anything other than false or null, then run as true-->
    <?php if ($article): ?>

        <article>
            <!--had to change from assoc array to obj format in order to tally with the getArticleById method-->
            <h2><?php echo htmlspecialchars($article[0]['title']) ?></h2> 

            <?php if ($article[0]['image_file']): ?>
                <img src="uploads/<?= $article[0]['image_file']; ?>" alt="">
            <?php endif; ?>

            <p><?php echo htmlspecialchars($article[0]['content']) ?></p>

            <!--only those with categories will make this code below to show-->
            <?php if ($article[0]['category_name']): ?>
                <p>Categories:
                    <?php foreach ($article as $a): ?>
                        <?= htmlspecialchars($a['category_name']); ?>
                    <?php endforeach; ?>
                </p>
            <?php endif; ?>


            <p><?php echo $article[0]['date_published']?></p>
        </article> 

        <!--we will repeat the same below too, array to obj -->
        <a href="edit_article.php?id=<?= $article[0]['id']; ?>">Edit</a>

        <a href="delete_article.php?id=<?= $article[0]['id']; ?>">Delete</a>

        <a href="edit_article_img.php?id=<?= $article[0]['id']; ?>">Edit Image</a>
     
    <?php else: ?>
        <!--this runs when the article it is false or null-->
        <p>No articles found.</p>
    <?php endif; ?>

<?php require "../includes/footer.php"; ?>


