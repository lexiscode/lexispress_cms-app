<?php

require "../includes/init.php";
/*require "classes/DbConnect.php";
require "classes/GetAll.php";
require "classes/Auth.php";*/


// Initialize the session.
session_start();

Auth::requireLogin();

// Connect to the Database Server
$conn = require "../includes/db.php";

// READING FROM THE DATABASE AND CHECKING FOR ERRORS
$articles = GetAll::getAll($conn);

?>


<!-- HTML header codes that ends with the body tag -->
<?php require "../includes/header.php"; ?>

<h1 align="center"><a href="http://localhost/lexispress_cms-app/index.php" style="text-decoration: none">-- LexisPress --</a></h1>
<h2>This is our Blog Posts</h2>

<!-- Working with Sessions-->
<!--<php var_dump($_SESSION); ?> -->

<?php if (Auth::isLoggedIn()): ?>
    <p>You are logged in. <a href="logout.php">Logout</a></p>
    <p>Welcome back!😊</p>
    <!-- only logged in user should access this link below-->
    <a href="new_article.php">New article</a>

<?php else: ?>
    <p>You are logged out. <a href="login.php">Login</a></p>
<?php endif; ?>

<!--Below we want all users to see this New Article link, even though not everyone will be allowed
to access it -->
<!--<a href="new_article.php">New article</a>-->

<h2>Administration</h2>

<?php if(!empty($articles)): ?>
    <table>
        <thead>
            <th>Title</th>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td>
                        <a href="article.php?id=<?= $article['id'];?>"><?= htmlspecialchars($article['title']);?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No articles found.</p>
<?php endif; ?>


<!-- HTML footer codes that ends with the closing body tag -->
<?php require "../includes/footer.php"; ?>
