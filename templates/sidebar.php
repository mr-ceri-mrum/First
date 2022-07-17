Меню сайта
<ul>
	<li><a href="/">Главная страница</a></li>
	<li><a href="/?do=about">О ресурсе</a></li>
	<li><a href="/?do=feedback">Обратная связь</a></li>
	<?php
		out_admin('<li><a href="/?do=admin">Админпанель</a></li>');
		out_user('<li><a href="/?do=admin">Авторизация</a></li>');
	?>
</ul>