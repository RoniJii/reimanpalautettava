<?php

function checkUser(PDO $dbcon, $username, $passwd){

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $sql = "SELECT password FROM user WHERE username=?";  
        $prepare = $dbcon->prepare($sql); 
        $prepare->execute(array($username)); 

        $rows = $prepare->fetchAll(); 
        foreach($rows as $row){
            $pw = $row["password"];  
            if( password_verify($passwd, $pw) ){  
                return true;
            }
        }
        return false;

    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}


function createUser(PDO $dbcon, $username, $passwd){

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $hash_pw = password_hash($passwd, PASSWORD_DEFAULT); 
        $sql = "INSERT IGNORE INTO user VALUES (?,?)"; 
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($username, $hash_pw)); 
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}

function createDbConnection(){

    try{
        $dbcon = new PDO('mysql:host=localhost;dbname=n0juro00', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }

    return $dbcon;
}

function returnError(PDOException $pdoex): void {
    header('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $pdoex -> getmessage());
    print json_encode($error);
    exit;
   }

function selectAsJson($dbcon, $sql) {
    $query = $dbcon->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($results);
}

?>