<?php
session_start();
//change user preference
if (isset($_POST['ids']))
{
    //array of checked puzzles.
    $ids = $_POST['ids'];
   //check if at least one puzzle is chosen
        //return false, if no puzzle is chosen
    if (count($ids) ==0)
    {
        echo json_encode(array('result'=>'fail', 'reason'=>'empty'));
        die;
    }
    require 'bin/database.php';
    $uid = $_POST['uid'];
    //get the key of uid array, which if id of chosen puzzle
    $ids = array_keys($ids);
    //implode array into string
    $ids = implode(',',$ids);
    //store the string back into user's preference_ids
    $db = new MGDatabase();
    $db->update("users",array('_id'=> new MongoId($uid)), array('$set'=> array('puzzle_preference'=>$ids)));
    echo json_encode(array('result'=>'success'));
    //
    require 'bin/user.php';
    $_SESSION['user'] = serialize(new User($uid));
    die;
    //return true to indication preference has been changed.
}
else
    echo json_encode(array('result'=>'fail', 'reason'=>'empty'));