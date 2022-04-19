<?php
	include('status_code_description.php');

	function message_pack_error($code) {
		$return = array("status" => $code, "description" => status_code_description($code));
		return json_encode($return);
	}

	function message_pack_success($code, $data) {
		if(sizeof($data) == 0) {
			$return = array("status" => $code, "description" => status_code_description($code));
		}
		else {
			$return = array("status" => $code, "description" => status_code_description($code), "data" => $data);
		}
		
		return json_encode($return);
	}
?>