<?php

namespace App\Pokemon\Entity;




class Pokemon
{
    protected $id;

    protected $name;

    protected $type1;

    protected  $type2;

    protected $sprite;

    protected $description;


    public function __construct($id, $name,$type1,$type2,$sprite,$desciption)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type1 = $type1;
        $this->type2 = $type2;
        $this->sprite = $sprite;
        $this->description = $desciption;
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

    /**
     * @return mixed
     */
    public function getType1()
    {
        return $this->type1;
    }

    /**
     * @param mixed $type1
     */
    public function setType1($type1)
    {
        $this->type1 = $type1;
    }

    /**
     * @return mixed
     */
    public function getType2()
    {
        return $this->type2;
    }

    /**
     * @param mixed $type2
     */
    public function setType2($type2)
    {
        $this->type2 = $type2;
    }

    /**
     * @return mixed
     */
    public function getSprite()
    {
        return $this->sprite;
    }

    /**
     * @param mixed $sprite
     */
    public function setSprite($sprite)
    {
        $this->sprite = $sprite;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function toJson()
    {
        $json_array = array('id' => $this->id,'name' => $this->name, 'type1'=> $this->type1,
            'type2'=>$this->type2,'sprite' => $this->sprite,'description'=>$this->description);

       $str = \GuzzleHttp\json_encode($json_array);

        return $str;
    }

}