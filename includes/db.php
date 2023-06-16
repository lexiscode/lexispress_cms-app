<?php

// Connect to the Database Server
// create new database object and get the connection by calling the method in the class
$db = new DbConnect();
return $db->getConn();
