<?php

require "includes/init.php";
/*require "classes/DbConnect.php";
require "classes/GetAll.php";
require "classes/Auth.php";*/


// Initialize the session.

// Connect to the Database Server
$conn = require "includes/db.php";

// READING FROM THE DATABASE AND CHECKING FOR ERRORS
$articles = GetAll::getAll($conn);

?>


<!-- HTML header codes that ends with the body tag -->
<?php require "includes/header.php"; ?>

<h2>This is our Blog Posts</h2>

<?php if(!empty($articles)): ?>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <article>
                    <!-- htmlspecialchars() prevents XSS attack or code injections -->
                    <h2><?= htmlspecialchars($article["title"]) ?></h2> 
                    <p><?= htmlspecialchars($article["content"]) ?></p>
                    <p><?= $article["date_published"]?></p>
                    <i><a href="article.php?id=<?= $article['id'];?>">Read more</a></i>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No articles found.</p>
<?php endif; ?>


<!-- HTML footer codes that ends with the closing body tag -->
<?php require "includes/footer.php"; ?>
