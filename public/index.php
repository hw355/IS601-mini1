<?php
/**
 * Created by PhpStorm.
 * User: hwa-wei
 * Date: 2/13/19
 * Time: 4:48 PM
 */

ini_set('display_errors', 'On');

error_reporting(E_ALL | E_STRICT);


echo '<html><head>';

echo '<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';

echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">';

echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>';

echo '</head></html>';

main::start("example.csv");

class main {

    static public function start($filename) {

        $records = csv::getRecords($filename);

        $table = html::generateTable($records);

        System::printPage($table);


    }
}

class csv {

    static public function getRecords($filename) {

        $file = fopen($filename, "r");

        $fieldNames = array();

        $count = 0;


        //first run is field name, following runs should be actual values.
        while (! feof($file)) {

            $record = fgetcsv($file);

            if($count == 0) {

                $fieldNames = $record;

            }else {

                $records[] = recordFactory::create($fieldNames, $record);

            }

            $count++;

        }

        fclose($file);

        return $records;

    }

}

class record {

    public function __construct(Array $fieldNames = null, Array $values = null) {

        $record = array_combine($fieldNames, $values);

        foreach ($record as $property => $value) {

            $this->createProperty($property, $value);

        }

    }

    //cannot put objects into foreach loop
    public function returnArray() {

        $array = (array) $this;

        return $array;

    }

    public function createProperty($name, $value) {

        $this->{$name} = $value;
    }



}

class recordFactory {

    static public function create(Array $fieldNames = null, Array $values = null) {

        $record = new record($fieldNames, $values);

        return $record;
    }

}

class html {

    static public function generateTable($records) {

        $count = 0;

        $arrays = array();

        foreach($records as $record) {

            $array = $record->returnArray();

            if($count == 0) {

                $fields = array_keys($array);

                $arrays[] = $fields;

                $values = array_values($array);

                $arrays[] = $values;

            }else{

                $values = array_values($array);

                $arrays[] = $values;

            }

            $count++;
        }

        return $arrays;

    }

    static public function returnTable($table) {


        return "<table class='table-striped'>".$table.'</table>';

    }

    static public function returnTh($Th) {

        return '<th scope="row">'.$Th.'</th>';

    }

    static public function returnTr($Tr = 5) {

        return '<tr>'.$Tr.'</tr>';

    }

    static public function returnTd($Td = 6) {

        return '<td>'.$Td.'</td>';

    }


}

class system {

    static public function printPage($table) {


    }

}