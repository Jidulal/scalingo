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

	
	$points = array(
		new Point('test_metric',0.64, ['host' => 'server01', 'region' => 'us-west'], ['cpucount' => 10], 1435255849	),
		new Point('test_metric',0.84, ['host' => 'server01', 'region' => 'us-west'], ['cpucount' => 10], 1435255849	)
	);
	
	$result = $database->writePoints($points, Database::PRECISION_SECONDS);
	
	echo "<pre>"; print_r($result); echo "</pre><br>";
?>