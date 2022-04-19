<?php
	include('config.php');
	include('lib/message_pack.php');

	// send header to client to handle it as json
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if(isset($_GET['opcode']) && isset($_GET['app_id'])) {
		// check if method is OPTION
		if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			// send empty body to acquire HTTPS cert
			header("HTTP/1.1 204 No Content");
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
			header("Access-Control-Allow-Headers: X-PINGOTHER, Content-Type");

			die();
		}
		// check if method is POST
		else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// process input
			$inputdata = file_get_contents("php://input");
			$phrasedata = json_decode($inputdata, true);

			if($phrasedata == NULL) {
				// process when data malfunction
				echo message_pack_error(405);
			}
			else {
				// start handling for user

				if($_GET['opcode'] == "user_login") {
					// process input
					$inputdata = file_get_contents("php://input");
					$phrasedata = json_decode($inputdata, true);

					if($phrasedata == NULL) {
						// process when data malfunction
						echo message_pack_error(432);
					}
					else {

					}
				}
				else if($_GET['opcode'] == "user_auth") {
					// process input
					$inputdata = file_get_contents("php://input");
					$phrasedata = json_decode($inputdata, true);

					if($phrasedata == NULL) {
						// process when data malfunction
						echo message_pack_error(432);
					}
					else {
						
					}
				}
				else if($_GET['opcode'] == "user_register") {
					// process input
					$inputdata = file_get_contents("php://input");
					$phrasedata = json_decode($inputdata, true);

					if($phrasedata == NULL) {
						// process when data malfunction
						echo message_pack_error(432);
					}
					else {
						
					}
				}
				else if($_GET['opcode'] == "user_delete") {
					// process input
					$inputdata = file_get_contents("php://input");
					$phrasedata = json_decode($inputdata, true);

					if($phrasedata == NULL) {
						// process when data malfunction
						echo message_pack_error(432);
					}
					else {
						
					}
				}
				else {
					echo message_pack_error(405);
				}
				
			}
		}
		// handle if method is not in list of allowed
		else {
			echo message_pack_error(405);
		}
	}
	else {
		echo message_pack_error(432);
	}
?>