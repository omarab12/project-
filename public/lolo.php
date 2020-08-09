<html>
<?php


$server = "localhost";
$username = "root";
$password = "";
$database = "laravel";
$ref='';
$newwb=$_GET['new'];

$conn = mysqli_connect($server,$username,$password) or die("Cannot connect to server");
$selectDb = mysqli_select_db($conn,$database) or die("Cannot connect to database");
$check=mysqli_query($conn,"select * from website where website_name='$newwb' ");
$checkrows=mysqli_num_rows($check);




$newid=$_GET['emshi'];


if($checkrows>0) {
  echo "<script>
  alert('Website name already registred!'); 
  window.history.go(-1);
</script>";
} else { 
$sql = "UPDATE website SET website_name='$newwb' WHERE website_id='$newid'";
}

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('Website name updated sucessfully!'); 
    window.history.go(-1);
</script>";
  } else {
    echo "Error updating record: " . $conn->error;
  }
  
  $conn->close();

 
  ?>
