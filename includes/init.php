<?php

/**
 * Autoload imports and initializes the sessions
 * 
 * Register an autoloader, start or resume the session etc.
 */

spl_autoload_register(function ($class){
    require dirname(__DIR__) . "/classes/{$class}.php";
});

session_start();
