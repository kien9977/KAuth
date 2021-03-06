<?php
	function status_code_description($code) {
		if($code == 200) {
			return "OK";
		}
		else if($code == 403) {
			return "Credential is invalid";
		}
		else if($code == 404) {
			return "App not found";
		}
		else if($code == 405) {
			return "Method not allowed";
		}
		else if($code == 432) {
			return "Lacking parameter(s)";
		}
		else if($code == 433) {
			return "[opcode] not valid, please read the documents carefully and then try again";
		}
		else if($code == 434) {
			return "[user_id] existed";
		}
		else if($code == 512) {
			return "SQL server(s) caused an error";
		}
		else {
			return "Unknown error";
		}
	}