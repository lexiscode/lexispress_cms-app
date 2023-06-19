<?php

require "../includes/init.php";
/*require "classes/DbConnect.php";
require "classes/Auth.php";*/

// restricts access to this page except the user is logged in
Auth::requireLogin();

// Connect to the Database Server
$conn = require "../includes/db.php";

// using tenary or null-coalescing operator to set default page parameters and isset parameters in one line
// $paginator = new Paginator(isset($_GET['page']) ? $_GET['page'] :1, 6);
$paginator = new Paginator($_GET['page'] ?? 1, 6, GetAll::getTotalRecords($conn));

// READING FROM THE DATABASE AND CHECKING FOR ERRORS
$articles = GetAll::getPage($conn, $paginator->limit, $paginator->offset);

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

    <!-- PAGINATION -->
    <nav>
        <ul>
            <li>
                <?php if ($paginator->previous):?>
                    <a href="/lexispress_cms-app/admin/index.php?page=<?= $paginator->previous; ?>">Previous</a>
                <?php else:?>
                    Previous
                <?php endif;?>
            </li>
            <li>
                <?php if ($paginator->next): ?>
                    <a href="/lexispress_cms-app/admin/index.php?page=<?= $paginator->next; ?>">Next</a>
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
<?php require "../includes/footer.php"; ?>
