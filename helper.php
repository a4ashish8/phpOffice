<?php
function removeSpecialCharacter($filename)
{
    // $result = str_replace(str_split('\\/:*?"<>|&%$#'),'_',trim($name, '()'));
    // $result = trim(str_replace(str_split('\\/:*?"<>|&%$#'),'_',$name), '()');
    $result = preg_replace('/[^\w\s.]/', '', $filename); // Remove special characters except alphanumeric, whitespace, and period
    return $result;
}

// function for count array length
function count_array($array)
{
    return is_array($array) ? count($array) : 0;
}


// sum of array value
function ArraySum($array)
{

    if (count_array($array) > 0) {
        $val = array_sum($array);
    } else {
        $val = 0;
    }
    return $val;
}

// remove duplicate value from array
function ArrayUnique($array)
{
    if (is_array($array) and  count_array($array) > 0) {
        $val = array_unique($array);
    } else {
        $val = array();
    }
    return $val;
}
function ArrayDiff($array1, $array2)
{
    if (count_array($array1) == 0) {
        $array1  = array();
    }
    if (count_array($array2) == 0) {
        $array2  = array();
    }
    $val = array_diff($array1, $array2);
    return $val;
}

function ArrayIntersect($array1, $array2)
{
    if (count_array($array1) == 0) {
        $array1  = array();
    }
    if (count_array($array2) == 0) {
        $array2  = array();
    }
    $val = array_intersect($array1, $array2);
    return $val;
}

// remove duplicate value from array
function ArrayValues($array)
{
    if (count_array($array) > 0) {
        $val = array_values($array);
    } else {
        $val = array();
    }
    return $val;
}

// merge array
function ArrayMerge($array1, $array2)
{
    if (count_array($array1) == 0) {
        $array1  = array();
    }
    if (count_array($array2) == 0) {
        $array2  = array();
    }
    $val = array_merge($array1, $array2);
    return $val;
}

// remove empty value from array
function ArrayFilter($array)
{
    if (count_array($array) > 0) {
        $val = array_filter($array);
    } else {
        $val = array();
    }
    return $val;
}



// convert value array to string type for string only
function ImplodeArrayString($type, $array)
{
    $implodedata = '-1';
    if (count_array($array) > 0) {
        $implodedata = implode("$type", $array);
    }
    return $implodedata;
}

// convert value array to string type for data base query
function ImplodeArray($array)
{
    $implodedata = '-1';
    if (count_array($array) > 0) {
        $implodedata = "'" . implode("','", $array) . "'";
    }
    return $implodedata;
}

function ArraykeyExist($array1, $array2)
{

    if (count_array($array2) > 0) {
        $val = array_key_exists($array1, $array2);
    } else {
        $val = array();
    }
    return $val;
}

// check variable is string or not and empty

function JsonDecode($string): array
{
    if ($string == 'null') {
        return array();
    }
    if (isset($string) && is_string($string) && $string !== '') {
        $val = json_decode($string, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $val;
        } else {
            // Handle JSON decoding error
            return array();
        }
    } else {
        return array();
    }
}


// check value in array
function InArray($val, $array)
{
    if (count_array($array) > 0) {
        return in_array($val, $array);
    } else {
        return false;
    }
}


// return key or array values
function ArrayKeys($array)
{
    if ($array !== null && is_array($array)) {
        $val = array_keys($array);
    } else {
        $val = array();
    }
    return $val;
}
// for array merge 
function ArrayMergeRecursive($array1, $array2)
{
    if (count_array($array1) == 0) {
        $array1  = array();
    }
    if (count_array($array2) == 0) {
        $array2  = array();
    }
    $val = array_merge_recursive($array1, $array2);
    return $val;
}
// for format num value
function Numberformat($string)
{
    if ($string != "") {
        $floatdata = floatval($string);
        $val = number_format($floatdata);
    } else {
        $val = 0;
    }
    return $val;
}

// for max value in array
function maxValue($array)
{
    $maxValue = 0;
    if (count_array($array) > 0) {
        $maxValue = max($array);
    }
    return $maxValue;
}

// for min value in array
function minValue($array)
{
    $minValue = 0;
    if (count_array($array) > 0) {
        $minValue = min($array);
    }
    return $minValue;
}

// for sort value in array
function araaySort($array)
{
    $val = array();
    if (count_array($array) > 0) {
        $val = arsort($array);
    }
    return $val;
}

// for chunnk of array
function arrayChunk($array, $key)
{
    $val = array();
    if (count_array($array) > 0) {
        $val = array_chunk($array, $key);
    }
    return $val;
}

// for first key of in array
function arrayKeyFirst($array)
{
    $firstKey = '';
    if (count_array($array) > 0) {
        $firstKey = array_key_first($array);
    }
    return $firstKey;
}


// for search in array
function arraySearch($key, $array)
{
    $arraySearch = '-1';
    if (count_array($array) > 0) {
        $arraySearch = array_search($key, $array);
    }
    return $arraySearch;
}


function stripTags($input)
{
    if (is_array($input)) {
        // Handle the array case if necessary, e.g., by applying strip_tags to each element
        return array_map('strip_tags', $input);
    }
    // Assume the input is a string
    return strip_tags($input);
}

function arrayColumn($array, $columnKey)
{
    $columnArray = [];
    if (count_array($array) > 0) {
        $columnArray = array_column($array, $columnKey);
    }
    return $columnArray;
}



function isValidYear($year)
{
    if (is_int($year) && $year >= 1970 && $year <= 2099) {
        return $year;
    } else {
        return -1; // return an integer instead of a string
    }
}


function removeSpecialCharacters($string)
{
    $removeSpecialCharacter = preg_replace('/[^A-Za-z0-9 ]/', '', $string);
    $removeSpece = strtolower(trim(str_replace(" ", "_", $removeSpecialCharacter)));
    return $removeSpece;
}

// divide value
function DivideValue($Value1, $Value2)
{
    if ($Value2 == 0) {
        return 0;
    } else {
        return     $Value1 / $Value2;
    }
}

function displayHtmlSafe($fieldValue)
{
    // Decode the special HTML entities and ensure HTML tags are displayed as text
    return htmlspecialchars_decode($fieldValue, ENT_QUOTES);
}
