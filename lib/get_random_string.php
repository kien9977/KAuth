<?php
	function get_random_string($maxlen){
		$string = '';
		
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
		for ($i = 0; $i < $maxlen; $i++) {
			$string .= $characters[rand(0, strlen($characters) - 1)];
		}
		
		return $string;
	}
?>