<?php
/*
    Below are the length definitions for the columns in the 
    flat file. You may use it, move it, delete it. Whatever 
    works for you. Please put all your code in this file and return
    it for review.
 */
$definitions = [
   ['name' => 'Serial Number', 'length' => 16, 'type' => 'int'],
    ['name' => 'Language', 'length' => 3, 'type' => 'string'],
    ['name' => 'Business Name', 'length' => 32, 'type' => 'string'],
    ['name' => 'Business Code', 'length' => 8, 'type' => 'string'],
    ['name' => 'Authorization Code', 'length' => 8, 'type' => 'string'],
    ['name' => 'Timestamp', 'length' => 20, 'type' => 'timestamp'],
];


/*Column One
Definition: serial number
Data Type: left padded integer
Length 16

Column Two
Definition: Language
Data Type: string
Length: 3

Column Three
Definition: Business Name
Data Type: string
Length: 32

Column Four
Definition: Business Code
Data Type: string
Length: 8

Column Five
Definition: Authorization Code
Data Type: string
Length 8

Column six
Definition: Timestamp
Data Type: string as (yyyy-mm-dd hh:mm:ss)
Length: 20*/