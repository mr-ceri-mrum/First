<?php
	// Проверка доступа к файлу
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	# Назначение файла: Модуль отображения содержимого главной страницы

	// Запрос всех новостей сайта ищ базы даных 
	$SQL = "SELECT * FROM `news_posts` ORDER BY id DESC";
	
	$result = mysqli_query($db, $SQL);
	
	if(mysqli_num_rows($result)){
		$shortNews = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		foreach($shortNews as $news){
			$date = date("d.m.Y", $news['addDate']);
			out_mod(<<<HTML
	<div class="news-box">
		<div class="nb-title"><h3>{$news['title']}</h3></div>
		<div class="nb-shortdescr">{$news['shortDescription']}
		</div>
		<div class="news-info-panel"><span>Просмотров:</span> {$news['viewCount']}, <span>автор:</span> {$news['author']}, <span>дата:</span> {$date}</div>
		<a href="/?do=news&id={$news['id']}"><div class="nb-link">ПОДРОБНЕЕ</div></a>
	</div>
HTML
);
		}
		
	}else{
		out_mod('В базе данных еще нет новостей');
	}

	
	out(load_template('temp_maincont.php'));
?>