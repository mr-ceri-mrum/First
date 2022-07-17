<?php
	// HACK PROTECT
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	out_mod(<<<HTML
	<div class="admin_title">Удаление новостей</div>
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
			if($_GET['confirm'] == 'true'){
				
				$SQL = "DELETE FROM `news_posts` WHERE id='{$newsId}'";
				
				if(mysqli_query($db, $SQL)){
					if(mysqli_affected_rows($db)){
						out_mod('Новотсь была удалена. <a href="/?do=admin&section=allnews">К списку всех новостей</a>');
					}else{
						out_mod('Новость уже удалена. <a href="/?do=admin&section=allnews">К списку всех новостей</a>');
					}
				}else{
					out_mod('Ошибка удаления новости: '.mysqli_errno($db).' '.mysqli_error($db));
				}
				
			}else{
				out_mod(<<<HTML
				<form method="GET" action="">
					<input type="hidden" name="do" value="admin" />
					<input type="hidden" name="section" value="deletenews" />
					<input type="hidden" name="id" value="{$newsId}" />
					<input type="hidden" name="confirm" value="true" />
					<br/>
					<br/>
					<br/>
					<center>
					<input type="submit" value="Удалить" />
					или <a href="javascript:history.back()">вернуться назад</a></center>
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