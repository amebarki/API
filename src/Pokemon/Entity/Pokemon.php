<?php

namespace App\Pokemon\Entity;

use Tebru\Gson\Annotation as Gson;



class Pokemon
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

    public function setNom($name)
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


}