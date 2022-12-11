<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Регистрация</title>
		<link rel="stylesheet" href="../css/auth.css">
	</head>
	<body>
		<form class="auth-form" action="../engine/registration.php" method="POST" enctype="multipart/form-data">
			<label>Логин</label>
			<input class="form-control" type="text" name="reg_login" placeholder="Введите логин">
			<label>Пароль</label>
			<input class="form-control" type="password" name="reg_pass" placeholder="Введите пароль">
			<label>Подтверждение пароля</label>
			<input class="form-control" type="password" name="reg_pass_confirm" placeholder="Подтвердите пароль">
			<label>Фото</label>
			<input class="form-control" type="file" name="photo">
			<label>Адрес эл. почты</label>
			<input class="form-control" type="text" name="email" placeholder="Введите адрес эл. почты">
			<button type="submit">Зарегистрироваться</button>
			<p>У вас уже есть аккаунт? - <a href="auth_form.php">Войти</a></p>
			<?php
				if(isset($_SESSION['pass_not_confirmed'])) {
				 	echo '<p class="not-confirmed"> ' . $_SESSION['pass_not_confirmed'] . ' </p>';
					unset($_SESSION['pass_not_confirmed']);
				}
			?>


		</form>
	</body>
</html>
