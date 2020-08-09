<html>
<?php


$server = "localhost";
$username = "root";
$password = "";
$database = "laravel";
$ref='';


$conn = mysqli_connect($server,$username,$password) or die("Cannot connect to server");
$selectDb = mysqli_select_db($conn,$database) or die("Cannot connect to database");
$newid=$_GET['emshi'];

$sql = "DELETE FROM website WHERE website_name='$newid'";


if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  
  $conn->close();

  header("location:delete");    
   

  ?>


