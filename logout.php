<?php

session_start();
require "func.php";

unset($_SESSION["user"]);
unset($_SESSION["login"]);

redirect_to("/Учебный проект/page_login.php");


?>