<?php
	function status_code_description($code) {
		if($code == 200) {
			return "OK";
		}
		else if($code == 405) {
			return "Method not allowed";
		}
		else if($code == 432) {
			return "Lacking parameter(s)";
		}
		else {
			return "Unknown error";
		}
	}