<?php
	include('config.php');
	include('lib/message_pack.php');

	// send header to client to handle it as json
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if(isset($_GET['opcode']) && isset($_GET['app_id'])) {
		echo "OK";
	}
	else {
		echo message_pack_error(432);
	}