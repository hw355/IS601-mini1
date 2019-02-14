<?php
/**
 * Created by PhpStorm.
 * User: hwa-wei
 * Date: 2/13/19
 * Time: 4:48 PM
 */

ini_set('display_errors', 'On');

error_reporting(E_ALL | E_STRICT);

main::start("example.csv");

class main {

    static public function start($filename) {

        $records = csv::getRecords($filename);

        $table = html::generateTable($records);

        system::printPage($table);

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
        print_r($record);

        $this->createProperty();

    }

    public function createProperty($name = 'first', $value = 'keith') {

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

        $table = $records;

        return $table;
    }

}

class system {

    static public function printPage($page) {


    }

}