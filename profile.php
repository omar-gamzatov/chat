<?php
	if (!isset($_SESSION))
	{
	    session_start();
	}
	require_once('engine/db_connect.php');
	if(isset($_POST['profile_comment'])) {
		$imported_id = $_POST['profile_comment'];
		$check_guest_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$imported_id'");
		$guest = mysqli_fetch_assoc($check_guest_user);
				$_SESSION['guest'] = [
				"guest_photo" => $guest['photo'],
				"guest_login" => $guest['login'],
				"guest_email" => $guest['email'],
				"guest_status" => $guest['status']
			];
	}

	$check_comments = mysqli_query($connect, "SELECT * FROM `profile_comments`");

	function esc($str) {
		return htmlspecialchars($str, ENT_COMPAT);
	}
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Профиль</title>
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/profile.css">
	</head>
	<body>
	<div>
		<div class="profile-div1">
			<h1>Страница пользователя</h1>	
		</div>
		<div class="profile-div2">
			<img class="photo" src="<?=esc($_SESSION['guest']['guest_photo'])?>">
			<div class="div2_1">Информация о пользователе
				<span><span class="text-left">Логин</span><span class="text-right"><?=esc($_SESSION['guest']['guest_login'])?></span></span> 
				<span><span class="text-left">Email</span><span class="text-right"><?=esc($_SESSION['guest']['guest_email'])?></span></span>
			</div>
		</div>
		<div class="profile-div3">
			<label>Status: </label>
			<span class="text-status"><?=esc($_SESSION['guest']['guest_status'])?></span>
		</div>
		<label>Комментарии</label>
		<?php while ($comments = mysqli_fetch_assoc($check_comments)): ?>
			<div class="profile-div4">
					<img class="comment-photo" src="<?=esc($comments['photo'])?>">
					<div class="div4_1">
						<span>
							<span class="comment-user-name">
								<form class="name" action="/profile.php" method="POST">
									<button class="button" name="profile_comment" value="<?=esc($comments['user_id'])?>"><?=esc($comments['login'])?></button>
								</form>
							</span>
							<span class="comment-date"><?= date('d.m.y H:i', $comments['date'])?></span>
						</span>
						<span class="comment"><?=esc($comments['comment'])?></span>
					</div>
			</div>
		<?php endwhile;?>
		<div class="form">
			<form action="/redirect.php" method="POST">

				<p><textarea class="form-control" placeholder="Ваш комментарий" name="profile_comment"></textarea></p>
				<p><input type="submit" class="btn btn-info btn-block" value="Отправить" autocomplete="off"></p>
			</form>
		</div>
	</div>
	<div class="back-to-chat">
		<form action="index.php">
			<button class="">Назад</button>
		</form>
	</div>

	</body>
</html>