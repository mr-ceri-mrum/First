<?php
	// Проверка доступа к файлу
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	# Назначение файла: Модуль обработки страницы обратной связи
	ob_start();
	require TEMPDIR.'temp_feedback.php';
	$content = ob_get_contents();
	ob_end_clean();
?>