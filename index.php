<?php
include('trackone.class.php');

function make_name($input)
{
	return ucwords(str_replace('_', ' ', $input));
}
$track = 'One';
$name = 'One';
if ( isset($_GET['track']) ):
	$track = htmlspecialchars($_GET['track']);
	$name = make_name($track);
	$t = new TrackOne($track);
	$t->create_table();
	$t->add_record();
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
