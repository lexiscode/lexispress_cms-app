<?php

require "../includes/init.php";
/*require "classes/DbConnect.php";
require "classes/Auth.php";*/

// restricts access to this page except the user is logged in
Auth::requireLogin();

// Connect to the Database Server
$conn = require "../includes/db.php";

// READING FROM THE DATABASE AND CHECKING FOR ERRORS
$articles = GetAll::getAll($conn);

?>


<!-- HTML header codes that ends with the body tag -->
<?php require "../includes/header.php"; ?>


<h2>Administration</h2>
<a href="new_article.php">New article</a>
<br> <br>

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
