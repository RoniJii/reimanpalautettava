<?php
require_once('headers.php');
require_once('functions.php');

$input = json_decode(file_get_contents('php://input'));
$username = filter_var($input->username,FILTER_SANITIZE_STRING);
$passwd = filter_var($input->password,FILTER_SANITIZE_STRING);

try {
    $password = password_hash($passwd, PASSWORD_DEFAULT);
    $db = createDbConnection();
    $query = $db->prepare('insert into user(username, password) values (:username, :password)');
    $query->bindValue(':username', $username,PDO::PARAM_STR);
    $query->bindValue(':password', $password,PDO::PARAM_STR);
    $query->execute();
    $query2 = $db->prepare('insert into info(username) values (:username)');
    $query2->bindValue(':username', $username,PDO::PARAM_STR);
    $query2->execute();
    

    header('HTTP/1.1 200 OK');
   $data = array('id' => $db->lastInsertId(), ':username' => $username, ':password' => $password);
   print json_encode($data);
   } catch (PDOException $pdoex) {
         
}