<?php

/**
 * User
 * 
 * A person or entity that can log in to the site
 */

class User
{

    public $id;
    public $username;
    public $password;

    /**
     * Authenticate a user by username and password
     * 
     * @param string $username Username
     * @param string $password Password
     * 
     * @return boolean True if the credentials are valid, null otherwise
     */

    public static function authenticate($conn, $username, $password)
    {
        $sql = "SELECT * FROM user
                WHERE username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();

        // fetches the results into a variable as an object
        $user = $stmt->fetch();

        if ($user){
            // verifies actual passwd with hashed passwd
            return password_verify($password, $user->password);
        }
    }
}


