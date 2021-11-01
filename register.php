<?php

session_start();
require "func.php";

$email = $_POST["email"];
$password = $_POST["password"];

$user = get_user_by_email($email);


if(!empty($user))
{
	set_flash_message("danger", "<strong>Уведомление!</strong> Данный эл. адрес уже занят другим пользователем.");
	redirect_to("/Учебный проект/page_register.php");
}

add_user($email, $password);

set_flash_message("success", "Пользователь успешно зарегистрован");
redirect_to("/Учебный проект/page_login.php");

?>