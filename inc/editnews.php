<?php
	// HACK PROTECT
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	out_mod(<<<HTML
	<div class="admin_title">Редактирование новостей</div>
HTML
);
	$newsId = (int) $_GET['id'];
	
	if($newsId){
		// Получение новости из базы данных
		$selectSQL = "SELECT * FROM `news_posts` WHERE id='{$newsId}'";
		
		$result = mysqli_query($db, $selectSQL);
		if(mysqli_num_rows($result)){
			$news = mysqli_fetch_assoc($result);
			
			// редактируем новость
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Получение и проверка данных
				$title = escapeStr($_POST['title']);
				$shortDescription = escapeStr($_POST['shortDescription']);
				$fullDescription = escapeStr($_POST['fullDescription']);
				$editDate = time();
				
				// Процедура проверки данных
				$trust = '';
				
				if(mb_strlen($title) < 8) $trust .= '<li>Не указан заголовок статьи: длина заголовка должна быть не менее 8-ми символов</li>';
				if(mb_strlen($shortDescription) < 30) $trust .= '<li>Не указано краткое описание новости: длина не мнее 30 символов</li>';
				if(mb_strlen($fullDescription) < 30) $trust .= '<li>Не указано полное описание новости: длина не мнее 30 символов</li>';
				
				if(!$trust){
					// Составляем запрос в базу данных
					$SQL = "UPDATE `news_posts` SET title='{$title}', shortDescription='{$shortDescription}', fullDescription='{$fullDescription}', lastEditDate='{$editDate}' WHERE id='{$newsId}'";
					
					if(mysqli_query($db, $SQL)){
						if(mysqli_affected_rows($db)){
							out_mod("Данные сохранены. <a href='/?do=admin&section=allnews'>К списку всех новостей</a>");
						}else{
							out_mod('Запрос был исполнен, но при этом не одна запись в базе данных небыла затронута');
						}
					}else{
							out_mod("Ошибка: Не удалось отредактировать новость в базу данных. ERROR: ".mysqli_errno($db).', '.mysqli_error($db));
					}
				}
			}else{
		out_mod(<<<HTML
		<form method="POST" action="" class="newsform">
		
			<p><span>Заголовок новости:</span> обязательно для заполнения</p>
			<input type="text" name="title" placeholder="Введите заголовок новости" value="{$news['title']}" />
			
			<p><span>Краткое описание новости:</span> обязательно для заполнения</p>
			<textarea name="shortDescription" placeholder="Укажите краткое описание">{$news['shortDescription']}</textarea>
			
			<p><span>Полное описание новости:</span> обязательно для заполнения</p>
			<textarea name="fullDescription" placeholder="Укажите полное описание">{$news['fullDescription']}</textarea>
			
			<input type="submit" value="Сохранить изменения" />
			
		</form>
HTML
);
			}
		}else{
			out_mod('Новост с таким ID не сущесвует в базе данных');
		}
		
	}else{
		out_mod('Не передна ID новости');
	}
?>