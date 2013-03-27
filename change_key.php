<?php
session_start();
if (isset($_POST['uid']))
{
    require 'bin/database.php';
    require_once 'bin/RandDotOrg.class.php';
    $uid = $_POST['uid'];
    $tr = new RandDotOrg();
    $private_key = $tr->get_strings(1, 20 , $digits=TRUE, $upperalpha=TRUE, $loweralpha=TRUE, $unique=TRUE);
    $private_key = $private_key[0];
    //update private key

    //update user cookie
    $db = new MGDatabase();
    $db->update("users",array('_id'=> new MongoId($uid)), array('$set'=> array('private_key'=> $private_key)));
    //TODO: catch error

    echo $private_key;
    require 'bin/user.php';
    $_SESSION['user'] = serialize(new User($uid));
    die;
}
