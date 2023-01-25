<?php

use \App\Csv;
use \App\CalculateMovingAverage;

require dirname(dirname(__FILE__)).'/vendor/autoload.php';


$collection = (new Csv(dirname(__FILE__).'/data/weather_statistics.csv'))->getAverageTemperatureCollection();

$period = isset($_POST['period'])? (int) $_POST['period']: 2;

$json = new stdClass;
$json->daily = CalculateMovingAverage::run($collection->toDaily(), $period);
$json->weekly = CalculateMovingAverage::run($collection->toWeekly(), $period);
$json->monthly = CalculateMovingAverage::run($collection->toMothly(), $period);



header("Content-type: application/json; charset=UTF-8");
header("Cache-Control: must-revalidate");
header("Pragma: no-cache");
header("Expires: -1");		
print json_encode($json);
