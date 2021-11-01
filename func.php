<?php 

function get_user_by_email($email)
{
	$pdo = new PDO("mysql:host=array;dbname=my_project;", "root", "");
	$sql = "SELECT * FROM users WHERE email=:email";
	$statement = $pdo->prepare($sql);
	$statement->execute(["email" => $email]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);
	return $user;
}

function add_user($email, $password)
{
	$pdo = new PDO("mysql:host=array;dbname=my_project;", "root", "");
	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$passwd = password_hash($password, PASSWORD_DEFAULT);
	$statement = $pdo->prepare($sql);
	$final = $statement->execute(["email" => $email, "password" => $passwd]);
	return $pdo->lastInsertId();
}

function set_flash_message($name, $message)
{
	$_SESSION[$name] = $message;
}

function redirect_to($path)
{
	header("Location: {$path}");
	exit;
}

function display_flash_message($name)
{
	if(isset($_SESSION[$name]))
	{
		echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\"> {$_SESSION[$name]}</div>";
		unset($_SESSION[$name]);
	}
}

function login($email, $password)
{
	$user = get_user_by_email($email);

	if($user)
	{
		if(password_verify($password, $user["password"]) === true)
		{
			$_SESSION["login"] = true;
			$_SESSION["user"] = $user;
			redirect_to("/Учебный проект/users.html");
		}
		else
		{
			set_flash_message("danger", "Неправильно введен пароль!");
			redirect_to("/Учебный проект/page_login.php");
		}
	}
	else
	{
		set_flash_message("danger", "Такого пользователя не существует!");
		redirect_to("/Учебный проект/page_login.php");
	}
	return true;
}
?>