<?php
require_once "database.php";
require_once "puzzle.php";
class User
{
    public $id;
    public $username;
    public $password;
    public $private_key;
    public $email;
    public $url;
    public $preference;
    public function __construct($user_id)
    {
       $db  = new MGDatabase();
        $this->id=$user_id;
       $cursor = $db->find("users",array('_id' => new MongoId($user_id)));
       $doc=iterator_to_array($cursor);
       foreach ($doc as $user)
       {
           $this->private_key =$user['private_key'];
           $this->username =$user['username'];
           $this->email =$user['email'];
           $this->password =$user['password'];
           $this->url =$user['url'];
           $this->preference= $user['puzzle_preference'];
       }
    }

    //return array of preference ids.
    public function get_preference()
    {
        //boundary check
        if (strlen($this->preference)==0)
            return array();
        //return array of puzzle objects based on user preference string
        $ids = explode(',',$this->preference);
        return $ids;
//        foreach ($ids as $id)
//        {
//            $puzzles[] = new Puzzle($id);
//        }
//        return $puzzles;
    }
    public static  function get_puzzles_class_name_array($user_id)
    {
        $db  = new MGDatabase();
        $cursor = $db->find("users",array('_id' => new MongoId($user_id)));
        $doc = $cursor->getNext();
        $puzzle_id_array = $doc['puzzle_preference'];
        $puzzle_id_array = explode(',',$puzzle_id_array);
        $class_name_array =array();
        foreach($puzzle_id_array as $id)
        {

        }
    }
}