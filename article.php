<?php

require "classes/DbConnect.php";
require "classes/GetArticleId.php";

// Connect to the Database Server
// create new database object and get the connection by calling the method in the class
$db = new DbConnect();
$conn = $db->getConn();

// This gets the id from the browser tab when the save button was clicked in the new article page
if (isset($_GET['id'])){

    // Reading from the database to get specific article row by their id
    $article = GetArticleId::getArticleById($conn, $_GET['id']); // this holds an associative array
    
} else {
    // no error message printed when there's no id included in the url link
    $article = null; 
}
?>

<?php require "includes/header.php"; ?>

    <h1 align="center"><a href="http://localhost/lexispress_cms-app/index.php" style="text-decoration: none">-- LexisPress --</a></h1>

    <!--if the article contents anything other than false or null, then run as true-->
    <?php if ($article): ?>

        <article>
            <!--had to change from assoc array to obj format in order to tally with the getArticleById method-->
            <h2><?php echo htmlspecialchars($article->title) ?></h2> 
            <p><?php echo htmlspecialchars($article->content) ?></p>
            <p><?php echo $article->date_published?></p>
        </article>

        <!--we will repeat the same below too, array to obj -->
        <a href="edit_article.php?id=<?= $article->id; ?>">Edit</a>

        <a href="delete_article.php?id=<?= $article->id; ?>">Delete</a>
        
        
     
    <?php else: ?>
        <!--this runs when the article it is false or null-->
        <p>No articles found.</p>
    <?php endif; ?>

<?php require "includes/footer.php"; ?>


