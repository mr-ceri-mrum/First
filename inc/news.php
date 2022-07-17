<?php
	// Проверка доступа к файлу
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	# Назначение файла: Модуль отображения новостей сайта
	
	$newsId = (int) $_GET['id'];
	
	if($newsId){
		$SQL = "SELECT * FROM `news_posts` WHERE id='{$newsId}'";
		
		$result = mysqli_query($db, $SQL);
		
		if($result){
			$news = mysqli_fetch_assoc($result);
			
			if($news){
				// Подсчет количества просмотров
				$news['viewCount']++;
				
				$SQL2 = "UPDATE `news_posts` SET viewCount='{$news['viewCount']}' WHERE id='{$newsId}'";
				
				mysqli_query($db, $SQL2);
				
				// Рендеринг новости
				dump($news);
				out_mod(load_template('fullnews.php'));
				
			}else{
				out_mod('<br><br/><br/><center>Новости с таким ID не сущевует</center>');
			}
		}else{
			out_mod('<br><br/><br/><center>Ошибка: Не удалось выполнить запрос в базу данных. ERRNO: '.mysqli_errno($db).', ERROR: '.mysqli_error($db).'</center>');
		}
	}else{
		out_mod('<br><br/><br/><center>Ошибка: Не передан ID новости</center>');
	}
	
	out(load_template('temp_news.php'));
?>