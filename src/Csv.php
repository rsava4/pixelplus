<?php

namespace App;

use App\AverageTemperatureCollection;

class Csv
{

    private $_csvFilename = null;

    public function __construct($csvFilename)
    {
        if(!file_exists($csvFilename)){
            throw new \Exception('Файл '.$csvFilename.' не найден');
        }
        $this->_csvFilename = $csvFilename;
    }

    public function getAverageTemperatureCollection()
    {
        $handle = fopen($this->_csvFilename, "r");
        $result = new AverageTemperatureCollection();
        $isHeader = true;
		
        while(($row=fgetcsv($handle,0,";")) !== false)
        {
            if ($isHeader)
            {
                $isHeader = false;
                continue;
            }
			$date = new \DateTimeImmutable($row[0]);
			$result->addItemFromArray(['date' => $row[0], 'temperature' => $row[1]]);
        }
        
        return $result;
    }

    
}