<?php

require "includes/db_connect.php";
require "includes/validate_article_form.php";
require "includes/auth.php";

session_start();

// this is no longer necessary if you won't display a link to the new article page for non-login users
if (!isLoggedIn()){
    die("Unauthorized. You must be logged in first.");
}

// defining the variables in the global
$title = '';
$content = '';
$date_published = '';

// why didn't we also declare $errors = []; above here?
/* The empty() below determines whether a variable is considered to be empty. A variable is considered 
empty if it does not exist or if its value equals FALSE. empty() does not generate a warning if the 
variable does not exist.
*/

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // getting fields contents, then checking for possible empty fields
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date_published = $_POST['date_published'];

    $errors = validateArticle($title, $content);

    // makes the date field "null" by default if not filled
    if ($date_published == ''){
        $date_published = null;
    }

    // the ADD functionality should go through if no errors (non-empty fields) are encountered
    if (empty($errors)){
        
        // connect to the database server
        $conn = connectDB();

        // inserts the data into the database server
        $sql = "INSERT INTO article (title, content, date_published)
                VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false){
            echo mysqli_error($conn);
        } else {
            // i - integer, d - double, s - string
            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $date_published);

            $results = mysqli_stmt_execute($stmt);

            // checking for errors, if none, then redirect the user to the new article page
            if ($results === false){
                echo mysqli_stmt_error($stmt);
            } else {
                $id = mysqli_insert_id($conn);
                // it is more advisable to use absolute paths below than relative path
                header("Location: http://localhost/lexispress_cms-app/article.php?id=$id"); 
                exit;
            }
        }

    }
 
}

?>


<!--HTML header-->
<?php require "includes/header.php"; ?>

<h1 align="center"><a href="http://localhost/lexispress_cms-app/index.php" style="text-decoration: none">-- LexisPress --</a></h1>
<h2>New Article</h2>

<!-- HTML form -->
<?php require "includes/article_form.php"; ?>

<!--HTML Footer-->
<?php require "includes/footer.php"; ?>