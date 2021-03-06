<?php
	include("get_random_string.php");

	function read_app_name($conn, $app_id) {
		$stmt = mysqli_prepare($conn, "SELECT app_name FROM app WHERE app_id = ?");
		mysqli_stmt_bind_param($stmt, "s", $app_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $app_name);
		mysqli_stmt_fetch($stmt);

		return $app_name;
	}

	function generate_new_secret($conn, $app_id) {
		$new_secret = get_random_string(64);

		$stmt = mysqli_prepare($conn, "UPDATE app SET secret = ? WHERE app_id = ?");
		mysqli_stmt_bind_param($stmt, "ss", $new_secret, $app_id);
		$res = mysqli_stmt_execute($stmt);

		if($res == true) {
			return $new_secret;
		}
		return "";
	}

	

	function insert_user_token($conn, $app_id, $user_id) {
		$token = get_random_string(128);

		$stmt = mysqli_prepare($conn, "INSERT INTO auth_user(app_id, user_id, token, created_at) VALUES (?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "ssss", $app_id, $user_id, $token, time());
		$res = mysqli_stmt_execute($stmt);

		if($res == true) {
			return $token;
		}
		return "";
	}

	function write_user_data($conn, $app_id, $user_id, $secret) {
		$stmt = mysqli_prepare($conn, "INSERT INTO user(app_id, user_id, secret, created_at) VALUES (?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "ssss", $app_id, $user_id, $secret, time());
		$res = mysqli_stmt_execute($stmt);

		return $res;
	}
?>