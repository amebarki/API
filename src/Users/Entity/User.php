<?php

namespace App\Users\Entity;

class User
{
    protected $id;

    protected $name;


    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }


    public function getName()
    {
        return $this->name;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['name'] = $this->name;

        return $array;
    }

    public function toJson()
    {
        $json_array = array('id' => $this->id,'name' => $this->name);
        $str = \GuzzleHttp\json_encode($json_array);
        return $str;
    }
}
