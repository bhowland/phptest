<?php
/**
*This file will take a file of data strings into human readable output.
*/

error_reporting(E_STRICT);
error_reporting(-1);

/**
*This function opens the file to be read, sends the file off and closes the file.
*@param $datafile is the data file to be evaluated by the program.
*@var $fp an open file.
*/
function kickoff($dataFile){
    $fp = fopen($dataFile,'r') or die ("can't open file");
    seperateRecords($fp);
    fclose($fp) or die("can't close file");
}

/**
*This function is where the work in done. Before eack line is read in to the program, 
*  it will be tested by the regular experession. IF it passes it will then be read.  
*  IF NOT it will be stored in an array and be printed at the end of the file.
*@param $fp the open file.
*@var $wrongFormatLine an array of incorrect formatted lines.
*@var $countBlankLine an array to track the blank lines.
*@var $count counts the amount of times ran in the while loop.
*/
function seperateRecords($fp){
    $regxString = '/[0-9]{16}[A-Z]{3}.{32}[0-9A-Z]{8}[0-9A-Z]{8}[ 0-9]{5}-[0-9]{2}-[0-9]{2}[ 0-4]{3}:[0-9]{2}:[0-9]{2}/';
    $wrongFormatLine = array();
    $countBlankLine = array();
    $count = 0;
    while ($s = fgets($fp,1024)) {
        $count++;
        if (preg_match($regxString, $s)) {
            $fields[1] = substr($s,0,16);  
            $fields[2] = substr($s,16,3);  
            $fields[3] = substr($s,19,32);
            $fields[4] = substr($s,51,8);
            $fields[5] = substr($s,59,8); 
            $fields[6] = substr($s,67,20);
            processFields($fields, $count);
        }
        elseif (strlen($s) > 1){
            array_push($wrongFormatLine, $count);
        }
        else {
            array_push($countBlankLine, $count);
        }   
    }
    print("\n");
    printArray($wrongFormatLine);
    printBlankLine($countBlankLine);
    print("\n");
}

/**
*Prints out the array for the incorrect format.
*@param $wrongFormatLine an array of the records in the wrong format.
*/
function printArray($wrongFormatLine){
    print('Record(s) Was Incorrect Format: ');
    foreach($wrongFormatLine as $child) {
        echo $child . " ";
    }
    print("\n");    
}

/**
*Prints out the blank lines of the data file.
*@param $countBlankLine an array of blank lines.
*/
function printBlankLine($countBlankLine){
    print('Blank Line(s): ');
    foreach($countBlankLine as $child2) {
       echo $child2 . " ";
    }
    print("\n");    
}

/**
*Prints out a easy to read fromat of each record.
*@param $fields array of the seperated fields.
*@param $count a count of each line.
*/
function processFields($fields, $count) {
    print("\nLine Number: {$count}
Serial Number: {$fields[1]}
Language: {$fields[2]} 
Business Name: " .  ltrim($fields[3]) . "
Business Code: {$fields[4]} 
Authorization Code: {$fields[5]}
Timestamp: {$fields[6]}\n"
    );
}
?>



<?php
// /*
//     Below are the length definitions for the columns in the 
//     flat file. You may use it, move it, delete it. Whatever 
//     works for you. Please put all your code in this file and return
//     it for review.
//  */
// $definitions = [
//    ['name' => 'Serial Number', 'length' => 16, 'type' => 'int'],
//     ['name' => 'Language', 'length' => 3, 'type' => 'string'],
//     ['name' => 'Business Name', 'length' => 32, 'type' => 'string'],
//     ['name' => 'Business Code', 'length' => 8, 'type' => 'string'],
//     ['name' => 'Authorization Code', 'length' => 8, 'type' => 'string'],
//     ['name' => 'Timestamp', 'length' => 20, 'type' => 'timestamp'],
// ];


// /*Column One
// Definition: serial number
// Data Type: left padded integer
// Length 16

// Column Two
// Definition: Language
// Data Type: string
// Length: 3

// Column Three
// Definition: Business Name
// Data Type: string
// Length: 32

// Column Four
// Definition: Business Code
// Data Type: string
// Length: 8

// Column Five
// Definition: Authorization Code
// Data Type: string
// Length 8

// Column six
// Definition: Timestamp
// Data Type: string as (yyyy-mm-dd hh:mm:ss)
// Length: 20*/




