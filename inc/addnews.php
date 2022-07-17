<?php
	// HACK PROTECT
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	out_mod(<<<HTML
	<div class="admin_title">Добавление новости на сайт</div>
HTML
);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		// .. добавляем новость
		dump($_POST);
		
		// Получение и проверка данных
		$title = escapeStr($_POST['title']);
		$shortDescription = escapeStr($_POST['shortDescription']);
		$fullDescription = escapeStr($_POST['fullDescription']);
		$addDate = time();
		$addAuthor = $_SESSION['user'];
		
		// Проверка заполнения полей
		$trust = '';
		
		if(mb_strlen($title) < 8) $trust .= '<li>Поле "Заголовок новости" должно иметь не менее 8-ми символов</li>';
		if(mb_strlen($shortDescription) < 30) $trust .= '<li>Поле "Краткое описание" должно иметь не менее 30 символов</li>';
		if(mb_strlen($fullDescription) < 30) $trust .= '<li>Поле "Полное описание" должно иметь не менее 30 символов</li>';
		
		
		if(empty($trust)){
			// Формирование запроса и его исполнение
			$SQL = "INSERT INTO `news_posts` (title, shortDescription, fullDescription, addDate, author) VALUES ('{$title}', '{$shortDescription}', '{$fullDescription}', '{$addDate}', '{$addAuthor}')";
			
			if(mysqli_query($db, $SQL)){
				out_mod('Новость успешно добавлена. <a href="/?do=admin&section=allnews">Список всех новостей</a>');
			}else{
				out_mod('Ошибка: запрос в базу данных не выполнен. <b style="color:red;">ERROR: '.mysqli_errno($db).' '.mysqli_error($db).'</b>');
			}
		}else{
			out_mod(<<<HTML
				<b>Вы не заполнили некоторые поля:</b>
				<ul>
					{$trust}
				</ul>
HTML
);
		}
	}else{
		out_mod(<<<HTML
		<form method="POST" action="" class="newsform">
		
			<p><span>Заголовок новости:</span> обязательно для заполнения</p>
			<input type="text" name="title" placeholder="Укажите заголовок новости" />
			
			<p><span>Краткое описание новости:</span> обязательно для заполнения</p>
			<textarea name="shortDescription" placeholder=""></textarea>
			
			<p><span>Полное описание новости:</span> обязательно для заполнения</p>
			<textarea name="fullDescription" placeholder=""></textarea>
			
			<input type="submit" value="Добавить новость" />
			
		</form>
HTML
	);
	}
?>