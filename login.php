<?php

session_start();
require "func.php";

$email = $_POST["email"];
$password = $_POST["password"];


login($email, $password);

?>