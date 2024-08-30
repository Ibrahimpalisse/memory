<?php
require '../classes/users.php';
$user = new User();
$user->logout();

header('Location: ../index.php');
exit();
?>