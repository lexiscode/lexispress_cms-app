<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
</head>
<body>

    <header>    
        <h1 align="center"><a href="http://localhost/lexispress_cms-app/index.php" style="text-decoration: none">-- LexisPress --</a></h1>
    </header>
    
<h2></h2>

    <nav>
        <ul>
            <li><a href="http://localhost/lexispress_cms-app/">Home</a></li>
            
            <?php if (Auth::isLoggedIn()): ?>

                <li><a href="http://localhost/lexispress_cms-app/admin/index.php">Admin</a></li>
                <li><a href="http://localhost/lexispress_cms-app/logout.php">Logout</a></li>

            <?php else: ?>

                <li><a href="http://localhost/lexispress_cms-app/login.php">Login</a></li>

            <?php endif; ?>
        </ul>
    </nav>

    <main>