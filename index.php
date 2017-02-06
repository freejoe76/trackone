<?php
include('trackone.class.php');

$track = 'One';
$name = 'One';
if ( isset($_GET['track']) ):
	$track = htmlspecialchars(str_replace('-', '_', $_GET['track']));
	$name = make_name($track);
	$t = new TrackOne($track);
	$t->create_table();
	$t->add_record();
	$rows = $t->query_table();
endif;

// Get a list of the databases for the homepage
$dbs = array();
if ( $track == 'One' ):
	foreach ( glob('./*.*') as $file ):
		if ( strpos($file, '.db') > 0 ):
			$dbs[] = str_replace('./', '', str_replace('.db', '', $file));
		endif;
	endforeach;
endif;


?><!DOCTYPE HTML>
<html>
<head>
	<title>Track <?php echo $name; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://cdn.foundation5.zurb.com/foundation.css">
	<?php if ( $track !== 'One' ): ?> <meta http-equiv="refresh" content="2; URL='../'"><?php endif; ?>

</head>
<body>
	<h1>Track <?php echo $name; ?> Thing</h1>
	<?php if ( count($dbs) > 0 ): ?>
	<h2>Currently tracking</h2>
	<?php foreach ( $dbs as $db ): 
	echo '<h3>' . make_name($db) . '</h3>';
	$t = new TrackOne($db);
	$rows = $t->query_table();
	echo '<p>' . count($rows) . ' entries.</p>';
	endforeach;
	endif;
	?>
</body>
</html>
