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
	echo "<pre>"; print_r(111111111111111111111); echo "</pre><br>";
	// vagrant ip
	$host = $url['host'];


	function randFloat($min, $max)
	{
		$range = $max-$min;
		$num = $min + $range * mt_rand(0, 32767)/32767;

		$num = round($num, 4);

		return ((float) $num);
	}
	echo "<pre>"; print_r(222222222222222); echo "</pre><br>";
	$client = new \InfluxDB\Client($host);
echo "<pre>"; print_r(33333333333333); echo "</pre><br>";
	$database = $client->selectDB(substr($url['path'], 1));

	/* if ($database->exists()) {
		$database->drop();
	} */

	//$database->create(new \InfluxDB\Database\RetentionPolicy('test', '12w', 1, true));
echo "<pre>"; print_r($database); echo "</pre><br>";
echo "<pre>"; print_r(44444444444444444444); echo "</pre><br>";

	$start = microtime(true);

	$countries = ['nl', 'gb', 'us', 'be', 'th', 'jp', 'nl', 'sa'];
	$colors = ['orange', 'black', 'yellow', 'white', 'red', 'purple'];
	$points = [];

	for ($i=0; $i < 1000; $i++) {
		$points[] = new \InfluxDB\Point(
			'flags',
			randFloat(1, 999),
			['country' => $countries[array_rand($countries)]],
			['color' => $colors[array_rand($colors)]],
			(int) shell_exec('date +%s%N')+mt_rand(1,1000)
		);
	};

	// insert the points
	$database->writePoints($points);
echo "<pre>"; print_r(555555555555555555555555); echo "</pre><br>";
	$end = microtime(true);

	$country = $countries[array_rand($countries)];
	$color = $colors[array_rand($colors)];
echo "<pre>"; print_r(666666666666666); echo "</pre><br>";
	$results = $database->query("SELECT * FROM flags WHERE country = '$country' LIMIT 5")->getPoints();
	echo "<pre>"; print_r($results); echo "</pre><br>";
	$results2 = $database->query("SELECT * FROM flags WHERE color = '$color' LIMIT 5")->getPoints();
	echo "<pre>"; print_r($results2); echo "</pre><br>";

	echo "Showing top 5 flags from country $country:" . PHP_EOL;
	print_r($results);
	echo PHP_EOL;

	echo "Showing top 5 flags with color $color:" . PHP_EOL;
	print_r($results2);


	echo PHP_EOL;
	echo sprintf('Executed 1000 inserts in %.2f seconds', $end - $start);
?>