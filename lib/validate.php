<?php
	function check_identity_key($conn, $app_id, $identity_key) {
		$stmt = mysqli_prepare($conn, "SELECT count(*) as count FROM app WHERE app_id = ? AND identity_key = ?");
		mysqli_stmt_bind_param($stmt, "ss", $app_id, $identity_key);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $count);
		mysqli_stmt_fetch($stmt);

		if($count == 0) {
			return false;
		}
		return true;
	}

	function check_app_secret($conn, $app_id, $app_secret) {

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

	function check_token_credential($conn, $app_id, $user_id, $token) {
		$stmt = mysqli_prepare($conn, "SELECT count(*) as count FROM auth_user WHERE app_id = ? AND user_id = ? AND token = ?");
		mysqli_stmt_bind_param($stmt, "sss", $app_id, $user_id, $token);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $count);
		mysqli_stmt_fetch($stmt);

		if($count == 0) {
			return false;
		} 
		return true;
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