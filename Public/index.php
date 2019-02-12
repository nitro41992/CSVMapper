<?php
/**
 * Created by PhpStorm.
 * User: kuchiman
 * Date: 2/7/19
 * Time: 9:23 PM
 */


main::start('Test.csv');

class main
{
    static public function start($file)
    {

        $records = csv::getRecords($file);
        $table = html::generateTable($records);
        system::printPage($table);


    }

}

class csv
{
    static public function getRecords($fileName)
    {

        if (file_exists($fileName)) {

            $file = fopen($fileName, 'r');

            $fieldNames = array();
            $count = 0;


            $records = null;
            while ((!feof($file) and ($record = fgetcsv($file)) !== FALSE)) {

                if ($count == 0) {
                    $fieldNames = $record;

                } else {
                    $records[] = recordFactory::create($fieldNames, $record);
                }
                $count++;

            }

            fclose($file);
            return $records;

        } else {

            echo('The file does not exist.');

        }
    }

}

class record
{
    public function __construct(Array $fieldNames = null, Array $values = null)
    {

        $record = array_combine($fieldNames, $values);

        foreach ($record as $key => $value) {

            $this->createProperty($key, $value);

        }
    }

    public function returnArray()
    {
        $array = (array) $this;
        return($array) ;

    }

    public function createProperty($name = null, $value = null)
    {
        $this->{$name} = $value;

    }


}

class recordFactory
{
    public static function create(Array $fieldNames = null, Array $values = null)
    {

        $record = new record($fieldNames, $values);
        return $record;

    }
}


class html
{
    static public function generateTable($records)
    {
        $array = null;
        foreach ($records as $record) {
            $array[] = $record->returnArray();
        }

        return $array;

    }
}


class system
{
    static public function printPage($value)
    {

        print_r($value);

    }

}