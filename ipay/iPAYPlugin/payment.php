<?php


$resourcePath = $_POST['resourcePath'];
$keystorePath = $_POST['keystorePath'];
$aliasName = $_POST['aliasName'];
$action = (int)$_POST['action'];
$currency = (int)$_POST['currency'];
$language = $_POST['language'];
$receiptURL = $_POST['receiptURL'];
$errorURL = $_POST['errorURL'];
$tokenFlag = $_POST['tokenFlag'];
$paymenttoken = $_POST['paymenttoken'];
$trackIdVal = $_POST['trackId'];
$apppymtdtlstmp_pk = (int)$_POST['apppymtdtlstmp_pk'];
$appdt_projectmst_fk = (int)$_POST['appdt_projectmst_fk'];
$appdt_apptype = (int)$_POST['appdt_apptype'];
$appdt_status = (int)$_POST['appdt_status'];
$env_type = $_POST['env_type'];

$amount = '';
if($env_type == 'demo'){
	$amount = 1;
} else if ($env_type == 'live'){
	$amount = $_POST['amount'];
}

	try 
	{
		require_once('http://localhost:8080/JavaBridge/java/Java.inc');
		$myObj = new Java("com.fss.plugin.iPayPipe");

		$myObj->setResourcePath(trim($resourcePath));
		$myObj->setKeystorePath(trim($keystorePath));
		$myObj->setAlias(trim($aliasName));
		$myObj->setAction(trim($action));
		$myObj->setCurrency($currency);
		$myObj->setLanguage(trim($language));
		$myObj->setResponseURL(trim($receiptURL));
		$myObj->setErrorURL(trim($errorURL));
		$myObj->setAmt($amount);
		$myObj->setTrackId($trackIdVal);
		$myObj->setUdf1($env_type);
		$myObj->setUdf2($apppymtdtlstmp_pk);
		$myObj->setUdf3($appdt_projectmst_fk);
		$myObj->setUdf4($appdt_apptype);
		$myObj->setUdf6($appdt_status);
		
		//$myObj->setUdf5('45.127.101.80');
		if(trim($myObj->performPaymentInitializationHTTP())!=0) 
		{
		  echo("ERROR OCCURED! SEE CONSOLE FOR MORE DETAILS");
		  return -1;
		}
		else
		{
		 echo  $payID = $myObj->getPaymentId().'<br>';
		 echo  $payURL =$myObj->getPaymentPage().'<br>';
		 echo  $url=$myObj->getWebAddress();
		 header( 'Location:'.$url ) ;
			die();
		}
	}
	catch(Exception $e)
	{	 
		echo 'Exception->' .$e;
		echo 'Message: ' .$e->getFile();
		echo 'Message1 : ' .$e->getCode();
	}
	
?>