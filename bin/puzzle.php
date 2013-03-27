<?php
require_once "database.php";
class Puzzle
{
    public $id;
    public $name;
    public $type;
    public $description;
    public $class_name;
    public function __construct($puzzle_id)
    {
        //if $key is an ID ( string or int)
        if (is_string($puzzle_id) || is_int($puzzle_id))
        {
            $db  = new MGDatabase();
            $this->id=$puzzle_id;
            $cursor = $db->find("puzzles",array('id' => intval($puzzle_id)));
            $docs=iterator_to_array($cursor);
            foreach ($docs as $puzzle)
            {
                $this->class_name =$puzzle['class_name'];
                $this->description =$puzzle['description'];
                $this->name =$puzzle['name'];
                $this->type =$puzzle['type'];
            }
        }
        //if $id is an document (object)
        else if (is_array($puzzle_id))
        {
            $this->id =$puzzle_id['id'];
            $this->class_name =$puzzle_id['class_name'];
            $this->description =$puzzle_id['description'];
            $this->name =$puzzle_id['name'];
            $this->type =$puzzle_id['type'];
        }
    }
    public  static function get_class_name_by_id($puzzle_id)
    {
        $db  = new MGDatabase();
        $cursor = $db->find("puzzles",array('id' => intval($puzzle_id)));
        $doc =      $cursor->getNext();
        $class_name = $doc[class_name];
        return $class_name;

}
}