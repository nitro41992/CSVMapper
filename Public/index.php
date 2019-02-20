<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>csvMapper</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"/>


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 50px">
    <a class="navbar-brand" href="#">csvMapper</a>
</nav>
<div class="container">
    <table class="table table-striped table-bordered">
        <?php
        $table = main::start('Test.csv');
        system::printPage($table);
        ?>
    </table>
</div>
</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: kuchiman
 * Date: 2/7/19
 * Time: 9:23 PM
 */


class main
{
    static public function start($file)
    {

        $records = csv::getRecords($file);
        $table = html::generateTable($records);
        return $table;

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
        $array = (array)$this;
        return ($array);

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
        $keys = null;
        $fields = null;
        $count = 0;
        foreach ($records as $record) {
            if ($count == 0) {
                $array = $record->returnArray();
                $fields[] = array_keys($array);


            } else {
                $array = $record->returnArray();
                $fields[] = array_values($array);


            }
            $count++;
        }

        $count = 0;
        $htmlArray[] = '<thead class="thead-dark">';
        foreach ($fields as $row) {

            if ($count == 0) {
                $htmlArray[] =  '<tr>';
                foreach ($row as $header) {
                    $htmlArray[] =  '<th scope="col">' . $header . '</th>';

                }
                $htmlArray[] =  '</tr>';
                $htmlArray[] =  '</thead>';
                $htmlArray[] =  '<tbody>';
            } else {
                $htmlArray[] =  '<tr>';
                foreach ($row as $value) {
                    $htmlArray[] =  '<td>' . $value . '</td>';
                }
                $htmlArray[] =  '</tr>';

            }
            $count++;
        }
        $htmlArray[] =  '</tbody>';

        $html = implode($htmlArray);

        return($html);

    }
}


class system
{
    static public function printPage($value)
    {

        print_r($value);

    }

}