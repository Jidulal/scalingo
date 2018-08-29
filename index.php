<?php
	$url = parse_url(getenv('SCALINGO_INFLUX_URL'));

	
	$db = array(
		'dsn'	=> getenv('SCALINGO_INFLUX_URL'),
		'hostname' => $url['host'] . ':' . $url['port'],
		'username' => $url['user'],
		'password' => $url['pass'],
		'database' => substr($url['path'], 1)
	);
	echo "<pre>"; print_r($db); echo "</pre><br>";
	
	
	
	require 'vendor/autoload.php';
	
	$client = new \InfluxDB\Client($url['host'], $url['port']);
	echo "<pre>"; print_r($client); echo "</pre><br>";
	
	$database = $client->selectDB(substr($url['path'], 1));
	echo "<pre>"; print_r($database); echo "</pre><br>";

	
?>