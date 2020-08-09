<html>
<?php

session_start();
$omar = $_SESSION['varname'] ;



// fill in your databasa data here!
$server = "localhost";
$username = "root";
$password = "";
$database = "laravel";
$ref='';

$connId = mysqli_connect($server,$username,$password) or die("Cannot connect to server");
$selectDb = mysqli_select_db($connId,$database) or die("Cannot connect to database");
$wb=$_GET['website'];
$check=mysqli_query($connId,"select * from website where website_name='$wb' ");
$checkrows=mysqli_num_rows($check);


if($checkrows>0) {
    echo "<script>
             alert('Website name already registred!'); 
             window.history.go(-1);
     </script>";
 } else {  


    
 $query = "INSERT IGNORE INTO website(website_id,user_id,website_name)    VALUES(DEFAULT,'$omar','$wb')";
 $result = mysqli_query($connId, $query) or die('Error querying database.');
 mysqli_close($connId);

 echo "<script>
 alert('Website added succesfully'); 
 window.history.go(-1);
</script>";
 }




 

?>