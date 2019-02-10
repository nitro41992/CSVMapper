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
            $file = '/home/kuchiman/Documents/Test.csv';
            //print_r ($file);
            $records = csv::getRecords($file);
            print_r($records);
            //$table = html::generateTable($records);
            //system::printPage($table);
    }

}

class csv {
    static public function getRecords($fileName) {
        if (file_exists($fileName)){
            //echo ('exists');
            $file = fopen($fileName, 'r');
            $parsedData= fread($file, filesize($fileName));
            fclose($file);

            $rows = explode(PHP_EOL, trim($parsedData));


            $items[] = array();
            foreach ($rows as $row) {
                $items[] = explode(',',trim($row));
            }

            return($items);

        } else {

            echo('not exist');

        }
    }

}


class html{
    static public function generateTable($records) {
        return $records = 'test';
    }
}


class system{
    static public function printPage($page) {

        echo($page);

    }

}