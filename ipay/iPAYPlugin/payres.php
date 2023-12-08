<?php

$resourcePath='K:\\xampp7\\htdocs\\vhost\\opaloman.om\\uat8686\\app\\ipay\\iPAYPlugin\\';

$aliasName='8999001';

require_once("http://localhost:8080/JavaBridge/java/Java.inc");

$myObj = new Java("com.fss.plugin.iPayPipe");

$myObj->setKeystorePath(trim($resourcePath));
$myObj->setAlias(trim($aliasName));
$myObj->setResourcePath(trim($resourcePath));

$myObj->parseEncryptedRequest(trim($_POST["trandata"]));

$resout = trim($myObj->getResult());
$envpath = $myObj->getUdf1();
$apppk = base64_encode($myObj->getUdf2());
$project = base64_encode($myObj->getUdf3());
$type = base64_encode($myObj->getUdf4());
$status = base64_encode($myObj->getUdf6());

$domain = '';
if($envpath == 'local'){
	$domain = "http://192.168.1.155:5200";
}else if($envpath == 'demo'){
	$domain = "https://opaloman.om/uat8686/app/home";
}elseif($envpath ==  'prelive'){
	$domain = "https://opaloman.om/prelive0805/prelive";
}elseif($envpath ==  'live'){
	$domain = $domain = "https://opaloman.om/app/home";
}

if($myObj->getUdf3() == '1' || $myObj->getUdf3() == '4'){
	header("Location: ".$domain."/trainingcentremanagement/maincentre?p=".$project."&t=".$type."&s=".$status."&at=".$apppk."&res=".$resout);
}else if($myObj->getUdf3() == '2' || $myObj->getUdf3() == '3'){
	header("Location: ".$domain."/standardcourse/home?p=".$project."&t=".$type."&s=".$status."&at=".$apppk."&res=".$resout);
}
die();	


?>