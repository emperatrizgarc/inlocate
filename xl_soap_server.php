<?php //xl_soap_server.php 20180225
	require_once("xl_lib/nusoap.php");
	
	$server = new soap_server();
	$server->configureWSDL("Locator","urn:Locator");
	 
	$server->register(  "updatelocation"
		              , array("name"   => "xsd:string")
		              , array("return" => "xsd:string")
		              , "urn:location"
		              , "urn:location#updatelocation"
		             );

	$server->register(  "registerlocation"
		              , array("name"   => "xsd:string")
		              , array("return" => "xsd:string")
		              , "urn:location"
		              , "urn:location#registerlocation"
		             );

	$server->register(  "getcurrentfloor"
		              , array("name"   => "xsd:string")
		              , array("return" => "xsd:string")
		              , "urn:location"
		              , "urn:location#getcurrentfloor"
		             );

	$server->register(  "getdefaultfloor"
		              , array("name"   => "xsd:string")
		              , array("return" => "xsd:string")
		              , "urn:location"
		              , "urn:location#getdefaultfloor"
		             );
	 
	function updatelocation($location) {
		
		$location = str_replace("[", "", $location);
		$location = str_replace("]", "", $location);

		$info     = explode("|", $location);

		$valuesg  	 	= $info[0];
		$mac_address 	= $info[1];
		$device_name 	= $info[2];
		$creation_date 	= date('Y-m-d H:i:s');
		$ctrl 			= 0;

		require 'xsql_connection.php';

		$sql    = "SELECT user_id
                    FROM  users 
                    WHERE mac_address = '$mac_address'
                   ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            	$user_id = $row["user_id"];
            	$ctrl 	 = 1;
            }
        } else {

        	require 'xphp_functions.php';

        	$color  = random_color();
        	$exists = verify_color($conn, $color);
        	
        	while ($exists == 1) {
        		$color  = random_color();
        		$exists = verify_color($conn, $color);
        	}
        	
        	$sql = "INSERT INTO users (
		                                   user_name
		                                  ,mac_address
		                                  ,color
		                                  ,creation_date
		                               )
		                        VALUES (
		                                 '".$device_name."'
		                                ,'".$mac_address."'
		                                ,'".$color."'
		                                ,'".$creation_date."'
		                               )
				    ";

		    if ($conn->query($sql) === true) {
		    	$user_id = $conn->insert_id;
		    	$ctrl 	 = 1;
		    } else {	
		    }
        }

        if ($ctrl == 1) { 

			$info       = explode(", ", $valuesg);
			$disteus    = array();
			$disteusn   = array();
			$dbcoor 	= array();
			$posible    = 0;
			
			for ($i=0; $i < count($info); $i++) { 
				
				$infoi = explode(" ", $info[$i]);

				$ap_mac_address = $infoi[0];
				$rss            = abs($infoi[1]);

				$sql    = "SELECT  dv.device_id
				                  ,dv.rss
				                  ,dv.x_location
				                  ,dv.y_location
				                  ,dv.device_value_id
		                    FROM  device_values dv
		                          inner join devices d on d.device_id = dv.device_id 
		                    WHERE d.mac_address = '$ap_mac_address'
		                    ORDER BY dv.rss DESC
		                   ";

		        $result = $conn->query($sql);

		        if ($result->num_rows > 0) {

					$disteusij  = 0;
					$sizen      = $result->num_rows;

		            while ($row = $result->fetch_assoc()) {
		            	$device_id       = $row["device_id"];
		            	$dbrss           = abs($row["rss"]);
		            	$x_location      = $row["x_location"];
		            	$y_location 	 = $row["y_location"];
		            	$device_value_id = $row["device_value_id"];

		            	//$disteusij      += pow(($rss-$dbrss), 2);

		            	$ds = sqrt(pow(($rss-$dbrss), 2));

		            	//if ($ds < 30) {
		            		$posible    += 1;
		            		$disteus[$device_value_id]	= $ds;
		            		$dbcoor[$device_value_id] 	= $x_location . " " . $y_location;
		            	//}
		            	
		            }

		            //$disteusn[$ap_mac_address] = sqrt($disteusij) / $sizen;
		        }  
			}

			//asort($disteus);

			//$asize 	 = count($disteus);
			
			if ($posible > 0) {		

				$counter = 0;
				$sumx    = 0;
				$sumy    = 0;

				foreach ($dbcoor as $key => $value) {
					$counter += 1;
					$xy       = explode(" ", $value);
					$sumx    += $xy[0];
					$sumy    += $xy[1];
				}

				$x_location = $sumx / $counter;
				$y_location = $sumy / $counter;
				$xy_coord   = $x_location . " " . $y_location;

				/*
				$min_distance 	 = min($disteus);							//Give me the min value on array...
				$device_value_id = array_search($min_distance, $disteus);   //Give me the registry where value is minimal...
				$coorxy          = $dbcoor[$device_value_id];               //Give me the coordinates of vector...			
				*/
			
				$sql = "INSERT INTO user_locations (
					                                   user_id
					                                  ,x_location
					                                  ,y_location
					                                  ,ginfo
					                                  ,creation_date
					                               )
					                        VALUES (
					                                 '".$user_id."'
					                                ,'".$x_location."'
					                                ,'".$y_location."'
					                                ,'".$location."'
					                                ,'".$creation_date."'
					                               )
					    ";

			    if ($conn->query($sql) === true) {
			    	$mylocation = $xy_coord;
			    	return $mylocation;
			    } else {
			    	$mylocation = "NaN" . " " . "NaN";
			   		return $mylocation; 	
			    }
			} else {
				$mylocation = "NaN" . " " . "NaN";
				return $mylocation;	
			}
		} else {
			$mylocation = "NaN" . " " . "NaN";
			return $mylocation;	
		}
	}

	function registerlocation($location) {

		$location = str_replace("[", "", $location);
		$location = str_replace("]", "", $location);

		$info     = explode("|", $location);

		$valuesg  	 			= $info[0];
		$device_mac_address 	= $info[1];
		$device_name 			= $info[2];

		$info           = explode(", ", $valuesg);

		require 'xsql_connection.php';

		for ($i=0; $i < count($info); $i++) { 
			
			$infoi = explode(" ", $info[$i]);

			$x_location 	= $infoi[1];
			$y_location 	= $infoi[2];
			$ap_mac_address = $infoi[3];
			$rss            = $infoi[4];
			$ap_device_name = "AP";

			$creation_date 	= date('Y-m-d H:i:s');
			$ctrl 			= 0;

	        $sql    = "SELECT device_id
	                    FROM  devices 
	                    WHERE mac_address = '$ap_mac_address'
	                   ";

	        $result = $conn->query($sql);

	        if ($result->num_rows > 0) {
	            while ($row = $result->fetch_assoc()) {
	            	$device_id = $row["device_id"];
	            	$ctrl 	   = 1;
	            }
	        } else {
	        	$sql = "INSERT INTO devices (
			                                   mac_address
			                                  ,device_name
			                                  ,creation_date
			                               )
			                        VALUES (
			                                 '".$ap_mac_address."'
			                                ,'".$ap_device_name."'
			                                ,'".$creation_date."'
			                               )
					    ";

			    if ($conn->query($sql) === true) {
			    	$device_id = $conn->insert_id;
			    	$ctrl 	 = 1;
			    } else {	
			    }
	        }

	        if ($ctrl == 1) {

			    $sql = "INSERT INTO device_values (
					                                   device_id
					                                  ,x_location
					                                  ,y_location
					                                  ,rss
					                                  ,creation_date
					                               )
					                        VALUES (
					                                 '".$device_id."'
					                                ,'".$x_location."'
					                                ,'".$y_location."'
					                                ,'".$rss."'
					                                ,'".$creation_date."'
					                               )
					    ";

			    if ($conn->query($sql) === true) {
			    	$mylocation = "Usted ha enviado: ". $location .".";
			    	//return $mylocation;
			    } else {
			   		//return "Su posición no pudo ser registrada."; 	
			    }
			} else {
				/*
				return "Su posición no pudo ser registrada, 
						porque el usuario no fue encontrado o falló su creación.";
				*/ 	
			}
		}	
	}

	function getcurrentfloor($location) {

		$location = str_replace("[", "", $location);
		$location = str_replace("]", "", $location);

		$info     = explode("|", $location);

		$valuesg  	 	= $info[0];
		$mac_address 	= $info[1];
		$device_name 	= $info[2];
		$creation_date 	= date('Y-m-d H:i:s');
		$ctrl 			= 0;

		require 'xsql_connection.php';

		$info       	= explode(", ", $valuesg);
		$disteus    	= array();
		$devices    	= array();
		$ftp_paths    	= array();
		$client_paths 	= array();
		
		for ($i=0; $i < count($info); $i++) { 
			
			$infoi = explode(" ", $info[$i]);

			$ap_mac_address = $infoi[0];
			$rss            = abs($infoi[1]);

			$sql    = "SELECT  dv.device_id
			                  ,dv.rss
			                  ,dv.device_value_id
			                  ,f.ftp_path
			                  ,f.client_path
	                    FROM  device_values dv
	                          inner join devices       d  on d.device_id  = dv.device_id
	                          inner join floor_devices fd on fd.device_id = dv.device_id
	                          inner join floors        f  on f.floor_id   = fd.floor_id       
	                    WHERE d.mac_address = '$ap_mac_address'
	                    ORDER BY dv.rss DESC
	                   ";

	        $result = $conn->query($sql);

	        if ($result->num_rows > 0) {

				$disteusij  = 0;
				$sizen      = $result->num_rows;

	            while ($row = $result->fetch_assoc()) {
	            	$device_id       = $row["device_id"];
	            	$dbrss           = abs($row["rss"]);
	            	$x_location      = $row["x_location"];
	            	$y_location 	 = $row["y_location"];
	            	$device_value_id = $row["device_value_id"];
	            	$ftp_path        = $row["ftp_path"];
	            	$client_path 	 = $row["client_path"];

	            	$ds = sqrt(pow(($rss-$dbrss), 2));

            		$disteus[$device_value_id]	 	= $ds;
            		$devices[$device_value_id] 	 	= $device_id;
            		$ftp_paths[$device_value_id] 	= $ftp_path;
            		$client_paths[$device_value_id] = $client_path;
	            }
	        }  
		}

		$min_distance = min($disteus); 									//Give me the min value on array...

		if ($min_distance !== FALSE) {
			$device_value_id = array_search($min_distance, $disteus);   //Give me the registry where value is minimal...
			$device_id       = $devices[$device_value_id];              //Give me the coordinates of vector...
			$ftp_path        = $ftp_paths[$device_value_id];
			$client_path     = $client_paths[$device_value_id];

			$sql    = "SELECT  c.ip_address
			                  ,c.port_number
			                  ,c.username
			                  ,c.password
			                  ,c.creation_date
	                    FROM  connections c
	                   	WHERE c.connection_type_id = 1
	                    ORDER BY c.creation_date DESC
	                    LIMIT 1
	                   ";

	        $result = $conn->query($sql);

	        if ($result->num_rows > 0) {
	            while ($row = $result->fetch_assoc()) {
	            	$ip_address      = $row["ip_address"];
	            	$port_number 	 = $row["port_number"];
	            	$username 	 	 = $row["username"];
	            	$password 	 	 = $row["password"];
	            }
	        }

			$your_info 		 = trim($client_path) . " " . trim($ftp_path) 
								   . " " . $ip_address
								   . " " . $port_number
								   . " " . $username
								   . " " . $password
								   ;

		} else {
			$your_info = "0" . " " . "0";	
		}

	   	return $your_info; 
	}

	function getdefaultfloor($location) {

		require 'xsql_connection.php';

		$sql    = "SELECT  di.ftp_path
		                  ,di.client_path
		                  ,di.creation_date
                    FROM  default_images di
                    ORDER BY di.creation_date DESC
                    LIMIT 1
                   ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            	$ftp_path        = $row["ftp_path"];
            	$client_path 	 = $row["client_path"];
            }
        }

        $sql    = "SELECT  c.ip_address
		                  ,c.port_number
		                  ,c.username
		                  ,c.password
		                  ,c.creation_date
                    FROM  connections c
                   	WHERE c.connection_type_id = 1
                    ORDER BY c.creation_date DESC
                    LIMIT 1
                   ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            	$ip_address      = $row["ip_address"];
            	$port_number 	 = $row["port_number"];
            	$username 	 	 = $row["username"];
            	$password 	 	 = $row["password"];
            }
        }

		$your_info 		 = trim($client_path) . " " . trim($ftp_path) 
							   . " " . $ip_address
							   . " " . $port_number
							   . " " . $username
							   . " " . $password
							   ;
		return $your_info; 
	}

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
