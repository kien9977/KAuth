<?php
	include('config.php');
	include('lib/message_pack.php');
	include('lib/sql_manipulate.php');
	include('lib/validate.php');

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
			// start handling for app

			// handle event app not exist
			if(check_app_exist($conn, $_GET['app_id'])) {
				// on event opcode is generate_new_secret
				if($_GET['opcode'] == "generate_new_secret") {
					// process input
					$inputdata = file_get_contents("php://input");
					$phrasedata = json_decode($inputdata, true);

					if($phrasedata == NULL) {
						// process when data malfunction
						echo message_pack_error(432);
					}
					else {
						if(isset($phrasedata['identity_key'])) {
							if($phrasedata['identity_key'] != "") {
								if(check_identity_key($conn, $_GET['app_id'], $phrasedata['identity_key'])) {
									$res = generate_new_secret($conn, $_GET['app_id']);


									if($res == "") {
										echo message_pack_error(512);
										
									}
									else {
										$return_data = array("new_secret" => $res);
										echo message_pack_success(200, $return_data);
									}
								}
								else {
									echo message_pack_error(403);
								}
							}
							else {
								echo message_pack_error(432);
							}
						}
						else {
							echo message_pack_error(432);
						}
					}
					
				}
				// on event opcode is get_app_name
				else if($_GET['opcode'] == "get_app_name") {
					$return_data = array("app_id" => $_GET['app_id'], "app_name" => read_app_name($conn, $_GET['app_id']));
					echo message_pack_success(200, $return_data);
				}
				else {
					echo message_pack_error(433);
				}
			}
			else {
				echo message_pack_error(404);
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