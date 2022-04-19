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