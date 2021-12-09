<?php
session_start();

require_once('./functions.php');
require_once('./headers.php');

if( isset($_SESSION['user']) ){
    $username = $_SERVER['PHP_AUTH_USER'];
        try {
            $db = createDbConnection();
            selectAsJson($db, "select * from info where username='$username'");
        } catch (PDOException $pdoex) {
            returnError($pdoex);
        }
        exit; 
}

echo '{"info":"Tietojen hakeminen epäonnistui"}';
header('Content-Type: application/json');
header('HTTP/1.1 401');
exit;







