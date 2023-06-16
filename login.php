<?php

require "includes/init.php";
/*
require "classes/DbConnect.php";
require "classes/User.php";
*/

// Initialize the session.
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Connect to the Database Server
    $conn = require "includes/db.php";

    // Check if the submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['sign-in'])){
        if (!empty($_POST['username']) && !empty($_POST['password'])){
            if (User::authenticate($conn, $_POST['username'], $_POST['password'])){

                // this helps prevent session fixation attacks
                session_regenerate_id(true);

                $_SESSION['is_logged_in'] = true;
                
                // redirect to the index page
                header('Location: index.php');
                exit;

            } else {

                $error = "login details incorrect";
            }
        }
    }
}

?>

<?php require "includes/header.php"; ?>

<h1 align="center"><a href="http://localhost/lexispress_cms-app/index.php" style="text-decoration: none">-- LexisPress --</a></h1>

<h2>Login</h2>

<?php if (!empty($error)): ?>
    <p>* <i><?= $error ?></i></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <br> <br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <br> <br>

    <button type="submit" name="sign-in">Sign in</button>
</form>


<?php require "includes/footer.php"; ?>