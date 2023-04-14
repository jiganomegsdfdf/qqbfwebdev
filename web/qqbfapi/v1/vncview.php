<?php

$alltext = "";
function printl($text){
	global $alltext;
    #echo($text . '<br>');
	$alltext = $alltext . json_encode($text);
}
$token = str_replace('"', '', $_GET['auth']);
$tokenold = $token;
$token = md5($token);
if ($token == "9e78c5c20b172e66f75779d35040796a" or $token == "d2555ef8faa2788ebb5434b6dc9955cd"){
  //setting curl
  $url="http://qqbfwebdev.herokuapp.com/qqbfapi/v1/vnc.php?auth=" . $tokenold;
  $agent= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 OPR/82.0.4227.50';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_VERBOSE, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_USERAGENT, $agent);
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt_array($ch,array(
    CURLOPT_ENCODING=>'gzip, deflate',
    CURLOPT_HTTPHEADER=>array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: en-US,en;q=0.5',
                'Accept-Encoding: gzip, deflate',
                'Connection: keep-alive',
                'Upgrade-Insecure-Requests: 1',
     ),
  ));
  //get api request
  $content=curl_exec($ch);
  //to json
  $data = json_decode($content);
  //print balance(add to str)
  print($data->ip . ":" . $data->port . "<br>" . $data->name . "<br>");
  print("<img src='" . $data->url . "'><br>");
  //print balance(finally)
  $alltext = substr($alltext, 1, -1);
  print($alltext);
}else{
  printl("Error! incorrect token");  
  $alltext = substr($alltext, 1, -1);
  print($alltext);
}
?>