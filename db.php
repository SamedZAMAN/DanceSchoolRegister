<?php

$host = "localhost";
$username = "root";
$password= "";
$dbname= "danskayit";


$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname );

if($mysqli -> connect_errno){
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

?>
