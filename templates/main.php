<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?=$title?></title>
		<link rel="stylesheet" href="/styles/styles.css" />
<?out_admin("\t\t".'<link rel="stylesheet" href="/styles/admin.css" />'."\n")?>
<?out_admin("\t\t".'<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:"textarea"});</script>'."\n")?>
	</head>
	
	<body>
		<div id="wrapper">
			<div id="header"><?require TEMPDIR.'header.php'?></div>
			<div id="navigation"><?require TEMPDIR.'navigation.php'?></div>
			<div id="content-wrap">
				<div id="content"><?=$content?></div>
				<div id="sidebar"><?require TEMPDIR.'sidebar.php'?></div>
			</div>
		</div>
	</body>
</html>