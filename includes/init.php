<?php

/**
 * Autoload imports
 * 
 * Register an autoloader, start or resume the session etc.
 */

spl_autoload_register(function ($class){
    require "classes/{$class}.php";
});

