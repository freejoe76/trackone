<?php
include('trackone.class.php');

$track = 'One';
$name = 'One';
$details = 0;
if ( isset($_GET['details']) ) $details = 1;
if ( isset($_GET['track']) ):
	$track = htmlspecialchars(str_replace('-', '_', $_GET['track']));
	$name = make_name($track);
	$t = new TrackOne($track);
	$t->create_table();
	if ( $details == 0 ) $t->add_record();
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
	<link rel="stylesheet" type="text/css" href="http://denverpost.github.io/css/tufte.css">
	<?php if ( $track !== 'One' && $details == 0 ): ?> <meta http-equiv="refresh" content="2; URL='../'"><?php endif; ?>

</head>
<body>
	<h1>Track <?php echo $name; ?> Thing</h1>
	<?php if ( count($dbs) > 0 ): ?>
	<h2>Currently tracking</h2>
	<?php foreach ( $dbs as $db ): 
	echo '<h3><a href="' . $db . '/details/">' . make_name($db) . '</a></h3>';
	$t = new TrackOne($db);
	$rows = $t->query_table();
	$count = count($rows);
	$s = 's';
	if ( $count == 1 ) $s = '';
	echo '<p>' . $count . ' time' . $s . ', last updated ' . make_date($rows[$count - 1]['date']) . '</p>';
	endforeach;
	endif;
	?>
</body>
</html>
