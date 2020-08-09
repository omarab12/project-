<html>
<?php


// fill in your databasa data here!
$server = "localhost";
$username = "root";
$password = "";
$database = "laravel";
$ref='';

$connId = mysqli_connect($server,$username,$password) or die("Cannot connect to server");
$selectDb = mysqli_select_db($connId,$database) or die("Cannot connect to database");


$wb=$_POST['wesbite'];

$user=Auth::user()->id;
$strSQL = "INSERT INTO website(website_id,user_id,website_name)    VALUES(DEFAULT,'$user','$$wb')";
$test=mysqli_query($connId,$strSQL);

echo "SUCCESS";
?>