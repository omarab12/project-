<?php

$ip_from_here = json_decode(file_get_contents('http://ipinfo.io'));

$ip=$ip_from_here->ip;
$country_code = $ip_from_here->country;

echo '<img src="http://www.geognos.com/api/en/countries/flag/' .$country_code. '.png" width="18" heigh="12">';
echo $ip;
"\r\n" ;

echo $country_code;

echo $_SERVER['REMOTE_ADDR'];