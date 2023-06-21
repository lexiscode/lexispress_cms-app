<?php

require "../includes/init.php";
/*require "../classes/DbConnect.php";
require "../classes/GetArticleId.php";*/

// in this case of the admin page, you must be login to access this page
Auth::requireLogin();

// Connect to the Database Server
$conn = require "../includes/db.php";

// READING or RETRIEVING from the database to get specific article post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an object, which stores in $article variable
    $article = GetArticleId::getArticleById($conn, $_GET['id']); 

    if (!$article){
        // if a non-existing id number is in the link
        die("Invalid ID. No article found");
    }

} else {
    // if no id is in the link
    die("ID not supplied. No articles found");
}



// REPEAT VALIDATION, no need declaring $title, $content, or $date_published variables again here
if ($_SERVER["REQUEST_METHOD"] == "POST"){


    // this holds/stores any previously uploaded image
    $previous_image = $article->image_file;

    $confirm = $article->setImageFile($conn, null);
    
    if ($confirm){

        if ($previous_image){
            unlink("../uploads/$previous_image"); // deletes the previous image
        }
        
        header("Location: http://localhost/lexispress_cms-app/admin/edit_article_img.php?id={$article->id}"); 
        exit;
    }

}

?>


<!--HTML header-->
<?php require "../includes/header.php"; ?>

<h2>Delete Article Image</h2>

<?php if ($article->image_file): ?>
    <img src="../uploads/<?= $article->image_file; ?>" alt="">
<?php endif; ?>

<form action="" method="POST">

    <p>Are you sure?</p>

    <button>Delete</button>
    <a href="http://localhost/lexispress_cms-app/admin/edit_article_img.php?id=<?= $article->id; ?>">Cancel</a>

</form>

<!--HTML Footer-->
<?php require "../includes/footer.php"; ?>