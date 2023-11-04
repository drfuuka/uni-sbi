<?php

// Generate code

use Illuminate\Support\Facades\DB;

if (!function_exists('generate_number')) {
    function generate_number($tableName, $prefixField, $codeLength, $prefix, $useDate = false)
    {
        $data = DB::select('SELECT id, ' . $prefixField . ' FROM ' . $tableName . ' ORDER BY ID DESC LIMIT 1');
        if ($useDate === true) {
            $date = date('y') . date('m');
        } else {
            $date = null;
        }

        if (!empty($data)) {
            $number = $data[0]->$prefixField;

            $math = $codeLength + 1;
            $alphabet = substr($number, -$math, 1); //get alphabet prefix from number
            $getNumber = substr($number, -$codeLength); //get number prefix from number
            $count = str_pad('', $codeLength, '9', STR_PAD_LEFT); //create character 9 according to codeLength

            if ($getNumber == $count) { //if number from prefix reach $count (max value
                $alphabet = ++$alphabet; //incrementing alphabet;
                $newNumber = str_pad(1, $codeLength, '0', STR_PAD_LEFT);
            } else {
                $newNumber = intval($getNumber) + 1; //incrementing number
            }

            $indexing = str_pad($newNumber, $codeLength, '0', STR_PAD_LEFT); //set indexing as new number prefix

            $result = $date . $prefix . $alphabet . $indexing;
        } else {
            $indexing = str_pad(1, $codeLength, '0', STR_PAD_LEFT); //set default indexing from 1
            $result = $date . $prefix . 'A' . $indexing;
        }

        return $result;
    }
}