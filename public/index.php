<?php
/**
 * Created by PhpStorm.
 * User: hwa-wei
 * Date: 2/13/19
 * Time: 4:48 PM
 */

ini_set('display_errors', 'On');

error_reporting(E_ALL | E_STRICT);

main::start();

class main {

    static public function start() {

        $records = csv::getRecords();

        $table = html::generateTable($records);

        system::printPage($table);

    }
}

class csv {

    static public function getRecords() {

       

    }

}

class html {

    static public function generateTable() {


    }

}

class system {

    static public function printPage() {


    }

}