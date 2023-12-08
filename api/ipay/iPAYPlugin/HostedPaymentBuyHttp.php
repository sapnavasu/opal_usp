<?php

	// $resourcePath='D:\\xampp\\htdocs\\vhost\\demo.businessgateways.net\\ipay\\iPAYPlugin\\';
	// $keystorePath='D:\\xampp\\htdocs\\vhost\\demo.businessgateways.net\\ipay\\iPAYPlugin\\';
	// $aliasName='BGATEWAYS';
	// $action=1;
	// $currency=512;
	// $$language='USA';
	// $receiptURL='http://demo.businessgateways.net/index.php?r=common/pymtStatus';
	// $errorURL='http://demo.businessgateways.net/index.php?r=common/pymtCancel';
	// $amount='1.00';
	// $tokenFlag='2';
	// $paymenttoken='';
	
	try 
	{
		
		// $resourcePath='D:\\xampp\\htdocs\\vhost\\demo.businessgateways.net\\ipay\\iPAYPlugin\\';
		// $keystorePath='D:\\xampp\\htdocs\\vhost\\demo.businessgateways.net\\ipay\\iPAYPlugin\\';
		$resourcePath='K:\\xampp7\\htdocs\\vhost\\opaloman.om\\uat8686\\app\\api\\ipay\\iPAYPlugin\\';
		$keystorePath='K:\\xampp7\\htdocs\\vhost\\opaloman.om\\uat8686\\app\\api\\ipay\\iPAYPlugin\\';
		//$aliasName='BGATEWAYS';
		$aliasName='OPALOMAN';
		$action=1;
		$currency=512;
		$$language='USA';
		$receiptURL='https://opaloman.om/';
		$errorURL='https://opaloman.om/';
		$amount='1.00';
		$tokenFlag='2';
		$paymenttoken='';
		
		require_once('http://localhost:8080/JavaBridge/java/Java.inc');
		
		$myObj = new Java("com.fss.plugin.iPayPipe");

		$rnd = substr(number_format(time() * rand(),0,'',''),0,10);

		$trackid = $rnd;
		$myObj->setResourcePath(trim($resourcePath));
		$myObj->setKeystorePath(trim($resourcePath));
		$myObj->setAlias(trim($aliasName));
		$myObj->setAction(trim($action));
		$myObj->setCurrency($currency);
		$myObj->setLanguage(trim($language));
		$myObj->setResponseURL(trim($receiptURL));
		$myObj->setErrorURL(trim($receiptURL));
		$myObj->setAmt($amount);
		$myObj->setTrackId($trackid);
		$myObj->setUdf1('ODC');
		$myObj->setUdf2('1685022232T985');
		$myObj->setUdf3('REG ');
		$myObj->setUdf4('27422');
		$myObj->setUdf5('77.83.63.44');
							
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