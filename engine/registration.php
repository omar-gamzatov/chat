<?php
	session_start();
	require_once('db_connect.php');

	$login = htmlspecialchars($_POST['reg_login'], ENT_QUOTES | ENT_IGNORE);
	$pass =  htmlspecialchars($_POST['reg_pass'], ENT_QUOTES | ENT_IGNORE);
	$pass_confirm =  htmlspecialchars($_POST['reg_pass_confirm'], ENT_QUOTES | ENT_IGNORE);
	$email =  htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_IGNORE);

	if($pass === $pass_confirm) {
		
		$pass = md5($pass);
		$path = 'uploads/' . time() . $_FILES['photo']['name']; // фото в папку uploads

		if(!move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path)) {
			$_SESSION['pass_not_confirmed'] = 'Ошибка при загрузке фото';
 			header('Location: ../signup_form/regist_form.php');
		} //ошибка при загрузке фото


		mysqli_query($connect, "INSERT INTO `users` (`id`, `login`, `password`, `email`, `photo`) VALUES (NULL, '$login', '$pass', '$email', '$path')"); // добавление юзера в бд

 		$_SESSION['pass_not_confirmed'] = 'Регистрация прошла успешно';
 		header('Location: ../signup_form/auth_form.php');
	

 	} else {
 		$_SESSION['pass_not_confirmed'] = 'Пароли не совпадают';
 		header('Location: ../signup_form/regist_form.php');
 	}
 ?>