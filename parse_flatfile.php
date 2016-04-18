<?php
/**
*This file will take an argument from the command line.
*  This file will be a data file with a certian format. 
*  Will then be ran through a program to seperate and output the inforamtion.
*@param $argv[1] the command line arg.
*/
include 'file_format.php';
kickoff($argv[1]);
?>