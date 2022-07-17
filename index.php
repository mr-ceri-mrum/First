<?
	# Назначение файла: Главная страница сайта, единая точка входа
	
	// Управление ошибками
	error_reporting(0);
	
	# Подключение технологии сессий
	session_start();
	
	# Создание константы для протекции внутренних файлов сайта
	define('CHECK', true);
	define('DOMAINS', 'http://newsbravo/');
	define('INCDIR', 'inc/');
	define('TEMPDIR', 'templates/');
	
	// Подключение библиотеки функуций
	require INCDIR.'functions.php';
	
	// Подключение файла базы данных
	require INCDIR.'dbconfig.php';
	
	// Авторизация на сервере базы данных
	$db = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db_name']);
	
	if($db){
		// Роутинг страниц
		$module = $_GET['do']; 
		$title  = ''; // в этой переменой будет содержаться заголовок страница которую просматривает пользователь
		$file = ''; // в данной переменной указывается имя и расширение php файла который отвечает за определенный раздел сайта
		
		if($module == 'news'){
			$title = "Новость сайта";
			$file = 'news.php';
		}elseif($module == 'about'){
			$title = "О нас";
			$file = 'about.php';
		}elseif($module == 'feedback'){
			$title = "Обратная связь";
			$file = 'feedback.php';
		}elseif($module == 'admin'){
			$title = "Панель управления сайтом";
			$file = 'admin.php';
		}else{
			if(is_null($module)){
				$title = "Главная страница";
				$file = 'maincont.php';
			}else{
				$title = "ERROR 404: Страница не найдена";
				$file = 'error.php';
			}
		}
		
		// Шаблонизатор 
		
		require INCDIR.$file;
		
		require TEMPDIR.'main.php';
	}else{
		echo "<br/><br/><center><h3>Ошибка: Нет подключения к серверу базы данных, попробуйте позже</h3></center>";
	}
?>