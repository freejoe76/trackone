<?php
include('sqlite.class.php');

function create_table($t)
{
	$db_name = $t . '.db';
	$db = new SQLite($db_name);
	$sql = "CREATE TABLE IF NOT EXISTS $t(id INTEGER PRIMARY KEY AUTOINCREMENT, date DATE);";
	$db->prepare($db_name, $sql);
	$db->execute($db_name);
	return true;
}
function record_item($t)
{
	$db_name = $t . '.db';
	$db = new SQLite($db_name);
	$sql = "INSERT INTO $t(date) VALUES (date('now'));";
	$db->prepare($db_name, $sql);
	$db->execute($db_name);
	return true;
}
function make_name($input)
{
	return ucwords(str_replace('_', ' ', $input));
}

$track = 'One';
if ( isset($_GET['track']) ):
	$track = htmlspecialchars($_GET['track']);
	$name = make_name($track);
	create_table($track);
	record_item($track);
endif;

?><!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $name; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://cdn.foundation5.zurb.com/foundation.css">

</head>
<body>
	<h1>Track <?php echo $name; ?> Thing</h1>
</body>
</html>
