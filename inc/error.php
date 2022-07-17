<?php
	// Проверка доступа к файлу
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	# Назначение файла: Модуль обработки ошибок

	// Сообщаем браузеру пользователя о том, что страницы нет
	header("HTTP/1.0 404 Not Found");
	
	ob_start();
	require TEMPDIR.'temp_error.php';
	$content = ob_get_contents();
	ob_end_clean();
?>