<?php
//CONNECTION TO DATABASE
global $connection;
// $servername = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = 'petshop';

$servername = 'remotemysql.com';
$username = '6ERBkPf7vZ';
$password = 'bf2B8cEzds';
$dbname = '6ERBkPf7vZ';


$connection = mysqli_connect($servername, $username, $password, $dbname);

//CHECKING THE CONNECTION
if(!$connection) {
    die('connection failed' . mysqli_connect_error());
}

//PRINT HOST INFORMATION
//echo 'connect successfully. Host info '. mysqli_get_host_info($connection);
?>