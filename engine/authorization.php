<?php
	session_start();
	require_once('db_connect.php');


	
	$login_for_auth = htmlspecialchars($_POST['auth_login'], ENT_QUOTES | ENT_IGNORE);
	$pass_for_auth = htmlspecialchars(md5($_POST['auth_pass']), ENT_QUOTES | ENT_IGNORE);
	$check_users = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login_for_auth' AND `password` = '$pass_for_auth'"); // проверка наличия строки в таблице users

	if (mysqli_num_rows($check_users) > 0) {

		$user = mysqli_fetch_assoc($check_users);

		$_SESSION['user'] = [
			"id" => $user['id'],
			"login" => $user['login'],
			"photo" => $user['photo']
		];

		header('Location: ../index.php');

	} else {
		$_SESSION['pass_not_confirmed'] = 'Неверный логин или пароль';
 		header('Location: ../signup_form/auth_form.php');
	}
?>