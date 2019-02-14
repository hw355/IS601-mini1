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

        while (! feof($file)) {

            $record = fgetcsv($file);

            $records[] = recordFactory::create($record);

        }

        fclose($file);

        return $records;

    }

}

class record {

    public function __construct(Array $record = null) {

        print_r($record);
    }
}

class recordFactory {

    static public function create(Array $array = null) {

        $record = new record($array);

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