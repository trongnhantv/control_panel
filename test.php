<?php
require 'bin/database.php';
$db = new MGDatabase();
$db->update("users",array('_id'=>new MongoId('5130f30d16d3124d77000016')),array('$set'=> array('puzzle_preference'=>"1,2")));
$cursor =$db->find("users",array('_id'=>new MongoId('5130f30d16d3124d77000016')));
foreach ($cursor as $doc)
    var_dump($doc);
//session_start();
//session_destroy();
//
//require_once 'bin/RandDotOrg.class.php';
//require 'bin/database.php';
//$uid = '512a95b616d312b877000006';
//$tr = new RandDotOrg();
//$private_key = $tr->get_strings(1, 20 , $digits=TRUE, $upperalpha=TRUE, $loweralpha=TRUE, $unique=TRUE);
//$private_key = $private_key[0];
//$db = new MGDatabase();
//$db->update("users",array('_id'=> new MongoId($uid)), array('$set'=> array('private_key'=> $private_key)));