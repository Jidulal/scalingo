<?php
	$url = parse_url(getenv('SCALINGO_INFLUX_URL'));

	
	$db = array(
		'dsn'	=> getenv('SCALINGO_INFLUX_URL'),
		'hostname' => $url['host'] . ':' . $url['port'],
		'username' => $url['user'],
		'password' => $url['pass'],
		'database' => substr($url['path'], 1)
	);
	echo "<pre>"; print_r($db); echo "</pre>";
?>