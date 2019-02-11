<?php
/**
 * Created by PhpStorm.
 * User: kuchiman
 * Date: 2/7/19
 * Time: 9:23 PM
 */


main::start();

class main {

    static public function start() {
            $file = 'Test.csv';
            $records = csv::getRecords($file);
            system::printPage($records);

    }

}

class csv {
    static public function getRecords($fileName) {
        if (file_exists($fileName)){

            $file = fopen($fileName, 'r');

            $records = array();
            while(! feof($file)) {

                $record = fgetcsv($file);
                $records[] = $record;

            }

            fclose($file);
            return $records;

        } else {

            echo('The file does not exist.');

        }
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