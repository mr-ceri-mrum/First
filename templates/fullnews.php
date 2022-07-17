<div id="fullnews">
	<div id="fntitle"><h1><?=$GLOBALS['news']['title']?></h1></div>
	<div class="fninfo" id="fnauthor"><span>Автор: <?=$GLOBALS['news']['author']?></span>, дата публкации: <?=date("d.m.Y", $GLOBALS['news']['addDate'])?></div>
	<div id="fndescription">
		<?=$GLOBALS['news']['fullDescription']?>
	</div>
	<div class="fninfo">
		<span>Просмотров: <?=$GLOBALS['news']['viewCount']?>
		
		<?if($GLOBALS['news']['lastEditDate']) echo " Дата посл.редактирования: ".date("d.m.Y", $GLOBALS['news']['lastEditDate']);?>
		
		<?if(isAdmin()) echo "<a href='/?do=admin&section=editnews&id={$GLOBALS['news']['id']}'> Редактировать</a>"?>
		
		</span>
	</div>
</div>