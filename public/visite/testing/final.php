<html>
<body>
<?php

function mysql_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}

$server = "localhost";
$username = "root";
$password = "";
$database = "laravel";

$connId = mysqli_connect($server,$username,$password) or die("Cannot connect to server");
$selectDb = mysqli_select_db($connId,$database) or die("Cannot connect to database");
$query="SELECT * FROM track";
$result=mysqli_query($connId,$query);
$num=mysqli_num_rows($result);

?>
<table border="1" cellspacing="2" cellpadding="2">
<tr>
<th><font face="Arial, Helvetica, sans-serif">id</font></th>
<th><font face="Arial, Helvetica, sans-serif">time</font></th>
<th><font face="Arial, Helvetica, sans-serif">http referer</font></th>
<th><font face="Arial, Helvetica, sans-serif">user agent</font></th>
<th><font face="Arial, Helvetica, sans-serif">ip address</font></th>
<th><font face="Arial, Helvetica, sans-serif">ip value</font></th>
<th><font face="Arial, Helvetica, sans-serif">domain</font></th>
<th><font face="Arial, Helvetica, sans-serif">tracking_page_name</font></th>
<th><font face="Arial, Helvetica, sans-serif">Host_name</font></th>
</tr>

<?php
$i=0;
while ($i < $num) {

    $f1=mysql_result($result,$i,"id");
    $f2=mysql_result($result,$i,"tm");
    $f3=mysql_result($result,$i,"ref");
    $f4=mysql_result($result,$i,"agent");
    $f5=mysql_result($result,$i,"ip");
    $f6=mysql_result($result,$i,"ip_value");
    $f7=mysql_result($result,$i,"domain");
    $f8=mysql_result($result,$i,"tracking_page_name");
    $f9=mysql_result($result,$i,"host_name");
?>

<tr>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f1; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f2; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f3; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f4; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f5; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f6; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f7; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f8; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f9; ?></font></td>
</tr>

<?php
$i++;
}
?>



</body>

</html>'
