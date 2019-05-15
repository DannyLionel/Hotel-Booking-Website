<?php
session_start();
unset($_SESSION['sess_user']);
unset($_SESSION['guestid']);
session_destroy();
//header('Location: ' . $_SESSION['redirecturl'].'');
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
