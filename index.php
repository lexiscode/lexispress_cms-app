<?php

require "includes/init.php";
/*require "classes/DbConnect.php";
require "classes/GetAll.php";
require "classes/Auth.php";*/


// Connect to the Database Server
$conn = require "includes/db.php";


// using tenary or null-coalescing operator to set default page parameters and isset parameters in one line
// $paginator = new Paginator(isset($_GET['page']) ? $_GET['page'] :1, 4);
$paginator = new Paginator($_GET['page'] ?? 1, 4, GetAll::getTotalRecords($conn));

// READING FROM THE DATABASE AND CHECKING FOR ERRORS
$articles = GetAll::getPage($conn, $paginator->limit, $paginator->offset);

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

    <!-- PAGINATION -->
    <nav>
        <ul>
            <li>
                <?php if ($paginator->previous):?>
                    <a href="?page=<?= $paginator->previous; ?>">Previous</a>
                <?php else:?>
                    Previous
                <?php endif;?>
            </li>
            <li>
                <?php if ($paginator->next): ?>
                    <a href="?page=<?= $paginator->next; ?>">Next</a>
                <?php else:?>
                    Next
                <?php endif;?>
            </li>
        </ul>
    </nav>

<?php else: ?>
    <p>No articles found.</p>
<?php endif; ?>


<!-- HTML footer codes that ends with the closing body tag -->
<?php require "includes/footer.php"; ?>
