<?php
if (!isset($_SESSION))
{
    session_start();
}
require_once('engine/db_connect.php');

function getRequestVar($var) {
	return isset($_POST[$var]) ? trim($_POST[$var]) : null;
}

function esc($str) {
	str_replace("'", "", $str);
	return htmlspecialchars(str_replace("'", "", $str), ENT_QUOTES | ENT_IGNORE);
}

if ($_POST['profile_comment']) { // если пришло имя и сообщение передаем в БД
	$export_date = time();
	$export_user_id = $_SESSION['user']['id'];
	$export_user_name = $_SESSION['user']['login'];
	$export_user_photo = $_SESSION['user']['photo'];
	$export_profile_comment = esc(getRequestVar('profile_comment'));
	mysqli_query($connect, "INSERT INTO `profile_comments` (`id`, `login`, `photo`, `comment`, `user_id`) VALUES (NULL, '$export_user_name', '$export_user_photo', '$export_profile_comment', '$export_user_id')");
	header('Location: profile.php');
}



if ($_POST['comment']) { // если пришло имя и сообщение передаем в БД
	$export_date = time();
	$export_user_name = $_SESSION['user']['login'];
	$export_comment = esc(getRequestVar('comment'));
	mysqli_query($connect, "INSERT INTO `posts` (`id`, `date`, `user_name`, `comment`) VALUES (NULL, '$export_date', '$export_user_name', '$export_comment')");
	header('Location: index.php');
}
?>