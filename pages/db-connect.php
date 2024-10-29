<?php
$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   ='dummy_db';

$conn = new mysqli($host, $username, $password, $dbname);
$prof = $conn->query("SELECT professeur FROM schedule_list");
if(!$conn){
    die("Cannot connect to the database.". $conn->error);
}