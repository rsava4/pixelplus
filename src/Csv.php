<?php

namespace App;

use App\AverageTemperatureCollection;

class Csv
{
	private $_csvFilename;

	/**
	 * Summary of __construct
	 * @param string $csvFilename
	 * @throws \Exception
	 */
    public function __construct(string $csvFilename)
    {
        if(!file_exists($csvFilename)){
            throw new \Exception('Файл '.$csvFilename.' не найден');
        }
        $this->_csvFilename = $csvFilename;
    }

	/**
	 * Summary of getAverageTemperatureCollection
	 * @return AverageTemperatureCollection
	 */
    public function getAverageTemperatureCollection()
    {
        $handle = fopen($this->_csvFilename, "r");
        $result = new AverageTemperatureCollection();
        $isHeader = true;
        while(($row=fgetcsv($handle,0,";")) !== false) {
            if ($isHeader) {
                $isHeader = false;
                continue;
            }
			$result->addItemFromArray(['date' => $row[0], 'temperature' => $row[1]]);
        }
        
        return $result;
    }

    
}