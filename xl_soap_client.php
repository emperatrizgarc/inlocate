<?php //xl_soap_client.php 20180225
	include("xl_lib/nusoap.php");
	$client = new soapclient("http://172.24.1.2:4692/xl_soap_server.php?wsdl");
	$result = $client->updatelocation("19.447220");
	echo "<pre>";
		print_r($result);
	echo "</pre>";