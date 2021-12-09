<?php
session_start();

require_once('headers.php');
require_once('functions.php');

if( isset($_SESSION['user']) ){

$input = json_decode(file_get_contents('php://input'));

$fname = filter_var($input->fname,FILTER_SANITIZE_STRING);
$lname = filter_var($input->lname,FILTER_SANITIZE_STRING);
$address = filter_var($input->address,FILTER_SANITIZE_STRING);
$age = filter_var($input->age,FILTER_SANITIZE_STRING);
$username = $_SERVER['PHP_AUTH_USER'];

try {
    $db = createDbConnection(); 
    $query = $db->prepare("UPDATE info SET fname=:fname, lname=:lname, address=:address, age=:age WHERE username=:username"); 
    $query->bindValue(':fname', $fname,PDO::PARAM_STR);
    $query->bindValue(':lname', $lname,PDO::PARAM_STR);
    $query->bindValue(':address', $address,PDO::PARAM_STR);
    $query->bindValue(':age',$age,PDO::PARAM_STR);
    $query->bindValue(':username',$username,PDO::PARAM_STR);
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array(':username' => $username, ':fname' => $fname, ':lname' => $lname, ':address' => $address, ':age' => $age);
    print json_encode($data);
   } catch (PDOException $pdoex) {
            returnError($pdoex);
}
    echo  json_encode( array("info"=>"Kirjauduit sisään")  );
    header('Content-Type: application/json');
    exit;

} 

echo '{"info":"Lisääminen epäonnistui"}';
header('Content-Type: application/json');
header('HTTP/1.1 401');
exit;
