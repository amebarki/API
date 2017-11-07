<?php

namespace App\Gamers\Entity;

class Gamer
{
    protected $id;

    protected $team;

    protected $pseudo;

    public function __construct($id, $team, $pseudo)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->team = $team;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setteam($team)
    {
        $this->team = $team;
    }

    public function setpseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getpseudo()
    {
        return $this->pseudo;
    }
    public function getteam()
    {
        return $this->team;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['team'] = $this->team;
        $array['pseudo'] = $this->pseudo;

        return $array;
    }
}
