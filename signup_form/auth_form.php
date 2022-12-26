<?php 
session_start();
unset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Авторизация</title>
		<link rel="stylesheet" href="../css/auth.css">
	</head>
	<body>
		<form class="auth-form" action='../engine/authorization.php' method="POST">
			<label>Логин</label>
			<input class="form-control" type="text" name="auth_login" placeholder="Введите логин">
			<label>Пароль</label>
			<input class="form-control" type="password" name="auth_pass" placeholder="Введите пароль" autocomplete="off">
			<button type="submit">Войти</button>
			<p>Нет аккаунта? - <a href="regist_form.php">Зергистрироваться</a></p>
			<?php
				if(isset($_SESSION['pass_not_confirmed'])) {
				 	echo '<p class="not-confirmed"> ' . $_SESSION['pass_not_confirmed'] . ' </p>';
					unset($_SESSION['pass_not_confirmed']);
				}
			?>
		</form>
	</body>
</html>
