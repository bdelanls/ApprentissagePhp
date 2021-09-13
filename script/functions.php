<?php 
include('script/globals.php');

/**
 * function de securize the form data
 * 
 * to transform array into some variables use: extract($values, EXTR_OVERWRITE)
 */
function treatFormData(array $data, string ...$wanted): array
{
    $values = [];
    foreach ($wanted as $value) {
        if (array_key_exists($value, $data)) {
            // trim function can be used also
            $actualData = stripslashes(($data[$value]));
            $actualData = htmlspecialchars($actualData);
            $values[$value] = $actualData;
        }
    }
    return $values;
}


/**
 * function to extrat data from json file
 * if the re is nothing inside, the function put the "tab" from DBTABLE constant inside
 */
function openDB(): array
{
    if(!file_exists(DBJSON)){
        file_put_contents(DBJSON, "");
    }
    
    $data = file_get_contents(DBJSON);
    $array = json_decode($data, true);
    if (!$array) {
        $array = [];
    }
    foreach (DBTABLE as $index => $table) {
        if (!array_key_exists($table, $array)) {
            $array[$table] = [];
        }
    }
    return $array;
}


/**
 * function to write data in DB
 */
function writeDB(array $data): bool
{
    $correct = true;
    $jsonData = json_encode($data);
    if (!$jsonData) {
        $correct = false;
    } else {
        $size = file_put_contents(DBJSON, $jsonData);
        if (!$size) {
            $correct = false;
        }
    }
    return $correct;
}

/**
 * function test File for uploading
 */
function testFile(){
    
}