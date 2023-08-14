<?php 
$host = "localhost";
$port = "5432";
$dbname = "gas_book_db";
$user = "postgres";
$password = "admin";
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$conn = pg_connect($connection_string) or die("Could not connect to Server\n");

if(!$conn){
    echo "Error : Unable to open database \n";
}
