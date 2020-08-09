<html>
<?php

session_start();
 $id = session_id();

// fill in your databasa data here!
$server = "localhost";
$username = "root";
$password = "";
$database = "laravel";
$ref='';

$connId = mysqli_connect($server,$username,$password) or die("Cannot connect to server");
$selectDb = mysqli_select_db($connId,$database) or die("Cannot connect to database");



$tracking_page_name="example";
$ref=$_SERVER['HTTP_REFERER'];
$agent=$_SERVER['HTTP_USER_AGENT'];
$line = date('Y-m-d H:i:s');
$ip_from_here = json_decode(file_get_contents('http://ipinfo.io'));

$country_code = $ip_from_here->country;

$ip=$ip_from_here->ip;
$sql="SELECT website_name FROM website WHERE website_id=42";
$connId->query($sql);

$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$strSQL = "INSERT INTO visite(visite_id,website_id,url,visitor_agent, ip,country,device_type,date,ref,visiteur_id)    VALUES(DEFAULT,42,'$sql','$agent','$ip','$country_code','$host_name','$line','$ref','$id')";





if ($connId->query($strSQL) === TRUE) {
    echo "Tracking successfully done";
  } else {
    echo "Error: " . $strSQL . "<br>" . $connId->error;
  }


  
 


?>



</html>

