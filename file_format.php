<?php

/**
*This function opens the file to be read, sends the file off and closes the file.
*args $datafile is the data file to be evaluated by the program.
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
*args $fp the open file.
*/
function seperateRecords($fp){
	$regxString = '/[0-9]{16}[A-Z]{3}.{32}[0-9A-Z]{8}[0-9A-Z]{8}[ 0-9]{5}-[0-9]{2}-[0-9]{2}[ 0-4]{3}:[0-9]{2}:[0-9]{2}/';
	$wrongFormatLine = array();
	$countBlankLine = array();
	while ($s = fgets($fp,1024)) {
		$count += 1;
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
*args $wrongFormatLine an array of the records in the wrong format.
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
*args $countBlankLine an array of blank lines.
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
*args $fields array of the seperated fields.
*args $count a count of each line.
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