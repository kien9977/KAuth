<?php
	function status_code_description($code) {
		if($code == 200) {
			return "OK";
		}
		else if($code == 432) {
			return "Lacking parameter(s)";
		}
		else {
			return "Unknown error";
		}
	}