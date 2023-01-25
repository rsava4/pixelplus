<?php

namespace App;
final class CalculateMovingAverage
{

	/**
	 * Summary of run
	 * @param mixed $data
	 * @param int $period
	 * @return array
	 */
    public static function run($data, int $period=2)
    {
        $index = 1;
        foreach($data as $key=>$value) {
            if($index>=($period)){
                $calcData = array_slice($data, $index - $period, $period);
				
                $sum = 0;
                foreach($calcData as $item) {
                    $sum += $item->getAverageTemperature();
                }
                $data[$key]->setMovingAverage(round($sum / $period, 1));
            }
            
            $index ++;
        }
		$result = [];
		foreach($data as $item){
			$result[] = $item->toArray();
		}
        return $result;
    }
}