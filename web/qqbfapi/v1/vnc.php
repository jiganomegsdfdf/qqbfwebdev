<?php

$alltext = "";

function get(){
	  $stack = array();
	  //setting curl
	  $url="https://computernewb.com/vncresolver/api/random";
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
	  $port = $data->port;
	  $ip = $data->ip;
	  $name = $data->clientname;
	  array_push($stack, $port, $ip, $name);
	  return $stack;
	  
	}
	
function get2(){
	$all = get();
	if (strpos($all[2], "QEMU") !== false){
		print('{"ip":"' . $all[1] . '","port":' . $all[0] . ',"name":"' . $all[2] . '","url":"' . str_replace("/", "/", "http://socket.computer/vncresolver/screenshots/" . $all[1] . "_" . $all[0] . ".jpg") . '"}');
	    #printl("" . $all[1]);
		#printl("<br>" . $all[0]);
		#printl("<br>" . $all[2]);
		#printl(str_replace("/", "\\", "<br>http://socket.computer/vncresolver/screenshots/" . $all[1] . "_" . $all[0] . ".jpg"));
	}else{
		get2();
	}
}
	
function printl($text){
	global $alltext;
    #echo($text . '<br>');
	$alltext = $alltext . json_encode($text);
}
$token = str_replace('"', '', $_GET['auth']);
$tokenold = $token;
$token = md5($token);
if ($token == "9e78c5c20b172e66f75779d35040796a" or $token == "d2555ef8faa2788ebb5434b6dc9955cd"){
	get2();
	$alltext = substr($alltext, 1, -1);
	print($alltext);
}else{
  printl("Error! incorrect token");  
  $alltext = substr($alltext, 1, -1);
  print($alltext);
}

?>