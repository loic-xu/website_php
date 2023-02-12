<?php 
    /*XXX à remplacer par les vrais valeurs*/
    define('DB_HOST', 'XXX');
    define('DB_USER', 'XXX');
    define('DB_PASS', 'XXX');
    define('DB_NAME', 'sauces');

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($conn->connect_error)
{
    die('Connection failed' . $conn->connect_error);
}

?>