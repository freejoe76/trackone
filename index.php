<?php
include('sqlite.class.php');

$t = 'test';
$db = new SQLite($t . '.db');
$sql = "CREATE TABLE IF NOT EXISTS $t(id INTEGER PRIMARY KEY AUTOINCREMENT, date DATE);";
$db->prepare($t, $sql);
$db->execute($t);


?>
<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
	<h1>Track One Thing</h1>
</body>
</html>
