<?php
	// Проверка доступа к файлу
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	// dump($_GET);
	// dump($_POST);
	// dump($_SESSION);
	// dump($_COOKIE);
	
	// Авторизация пользователя
	define('ADMLOGIN', 'user123');
	define('ADMPASSWORD', 'f5bb0c8de146c67b44babbf4e6584cc0');
	
	if(empty($_SESSION['user'])){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(ADMLOGIN == $_POST['login'] and ADMPASSWORD == md5($_POST['password'])){
				$_SESSION['user'] = ADMLOGIN;
			}else{
				out_mod('<span style="color:red;">Вы ввели неправильные данные!</span>');
			}
		}
	} 
	
	// Проверка авторизации пользоваетеля 
	if($_SESSION['user']){
		// Пользователь авторизован
		
		// Роутинг админпанели
		$section = $_GET['section'];
		
		if($section == 'addnews'){
			$title = 'Добавление новости на сайт';
			require INCDIR.'addnews.php';
		}elseif($section == 'editnews'){
			$title = 'Редактирование новости на сайт';
			
			require INCDIR.'editnews.php';
		}elseif($section == 'deletenews'){
			$title = 'Удаление новости на сайт';
			
			require INCDIR.'deletenews.php';
		}elseif($section == 'allnews'){
			$title = 'Список всех новостей сайта';
			require INCDIR.'allnews.php';
		}else{
			// Главная страница админпанели
			out_mod(load_template('temp_admin_main.php'));
		}
	}else{
		out_mod(<<<HTML
			<p>Вы не авторизованы. Заполинте след.поля для авторизации на сайте:</p>
			<form method="POST" action="">
				<input type="text" name="login" placeholder="Введте логин" />
				<input type="password" name="password" placeholder="Введте пароль" />
				<input type="submit" value="Отправить" />
			</form>
HTML
);
	}
	
	
	# Назначение файла: Модуль админпанели сайта
	out(load_template('temp_admin.php'));
?>