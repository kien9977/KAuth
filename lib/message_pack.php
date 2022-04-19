<?php
	include('status_code_description.php');

	function message_pack_error($code) {
		$return = array("status" => $code, "description" => status_code_description($code));
		return json_encode($return);
	}
?>