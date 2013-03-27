<?php

class MGDatabase
{
    private $connection;
    private $db;
    public function __construct($db=null)
    {
       try
       {
           if (!isset($db))
               $db = "SpamStatistics";
           $this->connection = new Mongo("mongodb://root:bees@kapow.cs.pdx.edu/SpamStatistics");
           $this->db = $this->connection->$db;
       }
       catch(MongoException $e)
        {
            trigger_error("cannot connect to database");
        }

    }
    public function insert($collection,$document)
    {
        $collection = $this->db->$collection ;
        $collection->insert($document);
    }
    public function count($collection)
    {
        $collection = $this->db->$collection ;
        return $collection->count();
    }
    public function find($collection,$query)
    {
        $collection = $this->db->$collection ;
        return $collection->find($query);
    }
    public function update($collection,$selection,$update,$option=array())
    {
        try
        {
            $collection = $this->db->$collection ;
        }
        catch (Exception $e)
        {echo 'cannot connect to db';}
        return $collection->update($selection, $update, $option);
    }

}
//$mongo = new MGDatabase();
//$mongo->insert("submit",array (
//    "name"=> "hellooooo",
//    "Nhan" => array(
//        "first" => "nhan",
//        "last"  => "Huynh"
//    )
//));
