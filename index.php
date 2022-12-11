<?php
session_start();
require_once("engine\db_connect.php");
require_once("engine\include_template.php");
if (!$_SESSION['user']['login'])
{
	header('Location: signup_form/auth_form.php');
}

if (getRequestVar('comment')) { // если пришло имя и сообщение
	$export_date = time();
	$export_user_name = $_SESSION['user']['login'];
	$export_comment = esc(getRequestVar('comment'));
	mysqli_query($connect, "INSERT INTO `posts` (`id`, `date`, `user_name`, `comment`) VALUES (NULL, '$export_date', '$export_user_name', '$export_comment')");

//	unset($export_date, $export_user_name, $export_comment);
}

$check_posts = mysqli_query($connect, "SELECT * FROM `posts`");

function getRequestVar($var) {
	return isset($_POST[$var]) ? trim($_POST[$var]) : null;
}

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
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body>
		<div id="wrapper">
			<h1>Чат</h1>
			<?= session_id()?>
				<?php while ($row=mysqli_fetch_assoc($check_posts)): ?>
					<div class="note">
						<p>
							<span class="date"><?= date('d.m.y H:i', $row['date'])?></span>
							<span class="name"><?= esc($row['user_name'])?></span>
						</p>
						<p><?= esc($row['comment'])?></p>
					</div>
				<?php endwhile;?>

			<div class="info alert alert-info">
				Запись успешно сохранена!
			</div>
			<div id="form">
				<form action="" method="POST">
					<p>Ваш ID:<?php echo $_SESSION['user']['id']?>  Ваш логин: <?php echo $_SESSION['user']['login']?></p>
					<p><textarea class="form-control" placeholder="Ваш комментарий" name="comment"></textarea></p>
					<p><input type="submit" class="btn btn-info btn-block" value="Сохранить" autocomplete="off"></p>
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
