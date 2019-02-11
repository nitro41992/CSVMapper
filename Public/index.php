<?php
/**
 * Created by PhpStorm.
 * User: kuchiman
 * Date: 2/7/19
 * Time: 9:23 PM
 */


main::start('Test.csv');

class main {
    static public function start($file) {

        $records = csv::getRecords($file);

        //system::printPage($records);

    }

}

class csv {
    static public function getRecords($fileName) {

        if (file_exists($fileName)){

            $file = fopen($fileName, 'r');

            $fieldNames = array();
            $count = 0;


            $records = array();
            while(! feof($file)) {

                $record = fgetcsv($file);
                if($count == 0) {
                    $fieldNames = $record;

                }else{
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

class record {
    public function __construct(Array $fieldNames = null, $values = null)
    {

        $record  = array_combine($fieldNames, $values);
        system::printPage($record);

        //$this->createProperty();

    }
    
    public function createProperty($name = null, $value = null){
        $this->{$name} = $value;

    }

}

class recordFactory{
    public static function create(Array $fieldNames = null, Array $values = null) {

        $record = new record($fieldNames, $values);
        return $record;

    }
}



class html{
    static public function generateTable($records) {

        return $records = 'test';

    }
}


class system{
    static public function printPage($value) {

        print_r($value);

    }

}