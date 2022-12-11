<?php
	unset($_SESSION['user']['id']);
	unset($_SESSION['user']['login']);
	header('Location: ../signup_form/auth_form.php');
?>