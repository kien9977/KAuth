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
			// handle event app not exist
			if(check_app_exist($conn, $_GET['app_id'])) {
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
						// verify then give a token

						if(isset($phrasedata['user_id']) && isset($phrasedata['secret'])) {
							if($phrasedata['user_id'] != "" && isset($phrasedata['secret']) != "") {
								if(check_login_credential($conn, $_GET['app_id'], $phrasedata['user_id'], $phrasedata['secret'])) {
									// start generate a token for user
									$token = insert_user_token($conn, $_GET['app_id'], $phrasedata['user_id']);
									if($token != "") {
										$return_data = array("app_id" => $_GET['app_id'], "user_id" => $phrasedata['user_id'], "token" => $token);
										echo message_pack_success(200, $return_data);
									}
									else {
										echo message_pack_error(512);
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
				else if($_GET['opcode'] == "user_auth") {
					// process input
					$inputdata = file_get_contents("php://input");
					$phrasedata = json_decode($inputdata, true);

					if($phrasedata == NULL) {
						// process when data malfunction
						echo message_pack_error(432);
					}
					else {
						// check if token work
						if(isset($phrasedata['user_id']) && isset($phrasedata['token'])) {
							if($phrasedata['user_id'] != "" && isset($phrasedata['token']) != "") {
								// verify if token is true
								if(check_token_credential($conn, $_GET['app_id'], $phrasedata['user_id'], $phrasedata['token'])) {
									echo message_pack_success(200, []);
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
				else if($_GET['opcode'] == "user_register") {
					// process input
					$inputdata = file_get_contents("php://input");
					$phrasedata = json_decode($inputdata, true);

					if($phrasedata == NULL) {
						// process when data malfunction
						echo message_pack_error(432);
					}
					else {
						// register a new user
						echo "SHIT";
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
						// delete an account
						echo "SHIT";
					}
				}
				else if($_GET['opcode'] == "user_deauth") {
					// process input
					$inputdata = file_get_contents("php://input");
					$phrasedata = json_decode($inputdata, true);

					if($phrasedata == NULL) {
						// process when data malfunction
						echo message_pack_error(432);
					}
					else {
						// delete an account
						echo "SHIT";
					}
				}
				else {
					echo "SHIT";
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