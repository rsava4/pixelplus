<?php

namespace App;

final class AverageTemperature
{
	
    private  $startDate;
    private  $endDate = null;
    private $temperatures = [];
    private $movingAverage = 0;

	/**
	 * Summary of __construct
	 * @param \DateTimeImmutable $date
	 * @param mixed $temperature
	 */
    public function __construct(\DateTimeImmutable $date, $temperature)
    {
        $this->startDate = $this->endDate = $date;
        $this->temperatures[] = $temperature;
    }

	/**
	 * Summary of getStartDate
	 * @return \DateTimeImmutable
	 */
    public function getStartDate()
    {
        return $this->startDate;
    }

	/**
	 * Summary of setEndDate
	 * @param \DateTimeImmutable $endDate
	 * @return void
	 */
    public function setEndDate(\DateTimeImmutable $endDate)
    {
        $this->endDate = $endDate;
    }

	/**
	 * Summary of getAverageTemperature
	 * @return float
	 */
    public function getAverageTemperature()
    {
        return round(array_sum($this->temperatures) / count($this->temperatures), 1);
    }

	/**
	 * Summary of addTemperature
	 * @param mixed $temperature
	 * @return void
	 */
    public function addTemperature($temperature)
    {
        $this->temperatures[] = $temperature;
    }

	/**
	 * Summary of setMovingAverage
	 * @param mixed $value
	 * @return void
	 */
    public function setMovingAverage($value){
        $this->movingAverage = $value;
    }

	/**
	 * Summary of toArray
	 * @return array
	 */
    public function toArray(){
        $result = [];

        $result['date'] = $this->startDate->format('z') === $this->endDate->format('z') ? $this->startDate->format('d.m.Y'): $this->startDate->format('d.m.Y')."-".$this->endDate->format('d.m.Y');
        $result['average_temperature'] = $this->getAverageTemperature();
        $result['moving_average'] = $this->movingAverage;

        return $result;
    }

}