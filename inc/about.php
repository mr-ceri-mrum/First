<?php
	// Проверка доступа к файлу
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	# Назначение файла: Модуль отображения страницы 'О нас'
	out(load_template('temp_about.php'));
?>