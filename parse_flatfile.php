<?php
/**
*This file will take an argument from the command line.
*  This file will be a data file with a certian format. 
*  Will then be ran through a program to seperate and output the inforamtion.
*  Was asked to make this file to run the command line in directions.
*@param $argv[1] the command line arg.
*/
//Directions say to put everything in this file.
include 'file_format.php';
//In the files given was asked to put everything is this file
//include 'format_file.php';
kickoff($argv[1]);
?>