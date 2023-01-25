<?php

namespace App;

use App\AverageTemperature;
use App\CalculateMovingAverage;
use DateTimeImmutable;

class AverageTemperatureCollection
{

	private $data = [];

	public function addItemFromArray(array $row)
	{
		$date = new DateTimeImmutable($row['date']);
		$key = $date->format('z');
		if(isset($this->data[$key])){
			$this->data[$key]->addTemperature($row['temperature']);
		}else{
			$this->data[$key] = new AverageTemperature($date, $row['temperature']);
		}
		ksort($this->data);
	}

	public function toDaily()
    {
        return $this->data;
    }
	
    public function toWeekly()
    {
        $result = [];
        $lastWeekDay = 0;
        $weekNumber = 0;
        foreach($this->data as $item){
            if($lastWeekDay == 0 || $lastWeekDay > $item->getStartDate()->format('N')){
                $weekNumber++;
                $result[$weekNumber] = new AverageTemperature($item->getStartDate(), $item->getAverageTemperature());
            }else{
                $result[$weekNumber]->addTemperature($item->getAverageTemperature());
                $result[$weekNumber]->setEndDate($item->getStartDate());
            }
            $lastWeekDay = $item->getStartDate()->format('N');
        }
		
        return $result;
    }

    public function toMothly()
    {
        $result = [];
        foreach($this->data as $item){
            $monthNumber = $item->getStartDate()->format('n');
            if(empty($result[$monthNumber])){
                $result[$monthNumber] = new AverageTemperature($item->getStartDate(), $item->getAverageTemperature());
            }else{
                $result[$monthNumber]->addTemperature($item->getAverageTemperature());
                $result[$monthNumber]->setEndDate($item->getStartDate());
            }
        }
        return $result;
    }



}