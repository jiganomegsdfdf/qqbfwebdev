<?php
$token = str_replace('"', '', $_GET['auth']);
$tokenold = $token;
$token = md5($token);
if ($token == "9e78c5c20b172e66f75779d35040796a" or $token == "d2555ef8faa2788ebb5434b6dc9955cd"){
	#$froms = ["djxmmx.net","alpha.mike-r.com","cygnus-x.net"];
	#$i = mt_rand(0,3);
	#$from = $froms[$i];
	$from = "djxmmx.net";
	$port = 17;
	$socket = socket_create(AF_INET, SOCK_STREAM, 0);
	socket_connect($socket, $from, $port);
	socket_recvfrom($socket, $buf, 4096, 0, $from, $port);
	print($buf);
}else{
  print("Error! incorrect token");  
}
?>