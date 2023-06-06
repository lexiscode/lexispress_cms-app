<?php

require "includes/db_connect.php";
require "includes/auth.php";

session_start();


// connect to the database server
$conn = connectDB();

// READING FROM THE DATABASE AND CHECKING FOR ERRORS
$sql = "SELECT * 
        FROM article 
        ORDER BY date_published DESC;";

$results = mysqli_query($conn, $sql); 

if ($results === false)
    echo mysqli_error($conn);
else
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
    //print_r($articles);  prints an associative array

?>


<?php require "includes/header.php"; ?>

<h1 align="center"><a href="http://localhost/lexispress_cms-app/index.php" style="text-decoration: none">-- LexisPress --</a></h1>
<h2>This is our Blog Posts</h2>

<!-- Working with Sessions-->
<!--<php var_dump($_SESSION); ?> -->

<?php if (isLoggedIn()): ?>
    <p>You are logged in. <a href="logout.php">Logout</a></p>
    <!-- only logged in user should access this link below-->
    <!--<a href="new_article.php">New article</a>-->
    <p>Welcome back!😊</p>

<?php else: ?>
    <p>You are logged out. <a href="login.php">Login</a></p>
<?php endif; ?>

<!-- Since a non-login user can't access this "new article" link below, lets remove it for them:
<a href="new_article.php">New article</a> 
-->
<a href="new_article.php">New article</a>

<?php if(!empty($articles)): ?>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <article>
                    <!-- htmlspecialchars() prevents code injections -->
                    <h2><?= htmlspecialchars($article["title"]) ?></h2> 
                    <p><?= htmlspecialchars($article["content"]) ?></p>
                    <p><?= $article["date_published"]?></p>
                    <i><a href="article.php?id=<?= $article['id'];?>" target="_blank">Read more</a></i>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No articles found.</p>
<?php endif; ?>

<?php require "includes/footer.php"; ?>


