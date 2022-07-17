<?php
	// HACK PROTECT
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	out_mod("<h2>Список всех новостей сайта:</h2>");
	
	// Запрос всех новостей сайта ищ базы даных 
	$SQL = "SELECT * FROM `news_posts`";
	
	$result = mysqli_query($db, $SQL);
	
	if(mysqli_num_rows($result)){
		$allNews = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		// Формирование и вывод таблицы новостей 
		
		out_mod("<table border='1px' style='border-color:black; width:100%;'>");
			out_mod('<tr>'."<th>Заголовок</th>"."<th>Просмотры</th>"."<th>Автор</th>"."<th>Действия</th>".'</tr>');
			foreach($allNews as $news){
				out_mod('<tr>'."<td>{$news['title']}</td>"."<td>{$news['viewCount']}</td>"."<td>{$news['author']}</td>"."<td><center><a href='/?do=admin&section=editnews&id={$news['id']}'><span>&#9998;</span></a>&nbsp;&nbsp;&nbsp;<a href='/?do=admin&section=deletenews&id={$news['id']}'><span>&#128465;</span></a></center></td>".'</tr>');
			}
		out_mod('</table>');
		
	}else{
		out_mod('В базе данных еще нет новостей');
	}
?>