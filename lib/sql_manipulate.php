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

	function check_login_credential($conn, $app_id, $user_id, $secret) {
		$stmt = mysqli_prepare($conn, "SELECT count(*) as count FROM user WHERE app_id = ? AND user_id = ? AND secret = ?");
		mysqli_stmt_bind_param($stmt, "sss", $app_id, $user_id, $secret);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $count);
		mysqli_stmt_fetch($stmt);

		if($count == 0) {
			return false;
		} 
		return true;
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

	function check_app_exist($conn, $app_id) {
		$stmt = mysqli_prepare($conn, "SELECT count(*) as count FROM app WHERE app_id = ?");
		mysqli_stmt_bind_param($stmt, "s", $app_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $count);
		mysqli_stmt_fetch($stmt);

		if($count > 0) {
			return true;
		}
		else {
			return false;
		}
	}
?>