<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "laravel";

$connId = mysqli_connect($server,$username,$password) or die("Cannot connect to server");
$selectDb = mysqli_select_db($connId,$database) or die("Cannot connect to database"); 

$result = "CREATE TABLE track(
`id` int(6) NOT NULL auto_increment,
`tm` varchar(20) NOT NULL default '',
`ref` varchar(250) NOT NULL default '',
`agent` varchar(250) NOT NULL default '',
`ip` varchar(20) NOT NULL default '',
`ip_value` int(11) NOT NULL default '0',
`domain` varchar(20) NOT NULL default '',
`tracking_page_name` varchar(10) NOT NULL default '',
 UNIQUE KEY `id` (`id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=latin1 "; 

if (mysqli_query($connId,$result))
{
 print "Success in TABLE creation!......";
} 
else 
{
die('MSSQL error: ' . mssqli_get_last_message());
}


?>'