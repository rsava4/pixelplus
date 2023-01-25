<?php

namespace App;

final class AverageTemperature
{
    private $startDate;
    private $endDate = null;
    private $temperatures = [];
    private $movingAverage = 0;

    public function __construct(\DateTimeImmutable $date, $temperature)
    {
        $this->startDate = $this->endDate = $date;
        $this->temperatures[] = $temperature;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setEndDate(\DateTimeImmutable $endDate)
    {
        $this->endDate = $endDate;
    }

    public function getAverageTemperature()
    {
        return round(array_sum($this->temperatures) / count($this->temperatures), 1);
    }

    public function addTemperature($temperature)
    {
        $this->temperatures[] = $temperature;
    }

    public function setMovingAverage($value){
        $this->movingAverage = $value;
    }

    public function toArray(){
        $result = [];

        $result['date'] = $this->startDate->format('z') === $this->endDate->format('z') ? $this->startDate->format('d.m.Y'): $this->startDate->format('d.m.Y')."-".$this->endDate->format('d.m.Y');
        $result['average_temperature'] = $this->getAverageTemperature();
        $result['moving_average'] = $this->movingAverage;

        return $result;
    }

}