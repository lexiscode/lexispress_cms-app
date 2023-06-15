<?php

/**
 * User
 * 
 * A person or entity that can log in to the site
 */

class User
{
    /**
     * Authenticate a user by username and password
     * 
     * @param string $username Username
     * @param string $password Password
     * 
     * @return boolean True if the credentials are valid, false otherwise
     */

    public static function authenticate($username, $password)
    {
        return $username == "lexiscode" && $password == "secret123";
    }
}


