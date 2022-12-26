<?php

if (!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION['user']['login']))
{
    header('Location: ../signup_form/auth_form.php');
}
    
require_once('engine/db_connect.php');

$check_posts = mysqli_query($connect, "SELECT * FROM `posts`");

function esc($str) {
	return htmlspecialchars($str, ENT_QUOTES | ENT_IGNORE);
}

?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Главная</title>
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="css/styles_main.css">
	</head>
	<body>
		<div id="wrapper">
			<h1>Just chat!</h1>
			<div class="chat">
				<?php while ($posts = mysqli_fetch_assoc($check_posts)): ?>
					<div>
						<div class="comment-body">
							<?php 
								$query_login = $posts['user_name'];
								$check_user_photo = mysqli_query($connect, "SELECT `photo`, `id` FROM `users` WHERE `login` = '$query_login'");
								$user = mysqli_fetch_assoc($check_user_photo);
							?>
							<img class="photo" src="<?=esc($user['photo'])?>">
							<span class="span1">
								<span class="span2">
									<form class="name" action="/profile.php" method="POST">
										<button class="button" name="profile_comment" value="<?= esc($user['id'])?>"><?= esc($posts['user_name'])?></button>
									</form>
									<span class="date"><?= date('d.m.y H:i', $posts['date'])?></span>
								</span>
							<span class="comment"><?= esc($posts['comment'])?></span>
							</span>
						</div>
					</div>
				<?php endwhile;?>
			</div>
			<div id="form">
				<form action="/redirect.php" method="POST">
					<p>Ваш ID:<?=esc($_SESSION['user']['id'])?>  Ваш логин: <?=esc($_SESSION['user']['login'])?></p>
					<p><textarea class="form-control" placeholder="Ваш комментарий" name="comment"></textarea></p>
					<p><input type="submit" class="btn btn-info btn-block" value="Отправить" autocomplete="off"></p>
				</form>
			</div>
			<div>
				<form action="signup_form/auth_form.php" method="POST">
					<p><input type="submit" name="exit" class="btn btn-info btn-block exit-btn" value="Выход"> </p>
				</form>
			</div>
		</div>
	</body>
</html>
