<?php

require "includes/init.php";
/*
require "classes/DbConnect.php";
require "classes/User.php";
*/


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Connect to the Database Server
    $conn = require "includes/db.php";

    // Check if the submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['sign-in'])){
        if (!empty($_POST['username']) && !empty($_POST['password'])){
            if (User::authenticate($conn, $_POST['username'], $_POST['password'])){

                Auth::login();
                
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