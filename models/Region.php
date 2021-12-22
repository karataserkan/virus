<?php
namespace app\models;

/**
 *
 */
class Region
{
    private bool $_infected;
    public int $x;
    public int $y;

    public $walls = [];
    public bool $controlled = false;
    public bool $spreaded = false;


    public function __construct(int $x, int $y, $infected = false)
    {
        $this->_infected = $infected;
        $this->x = $x;
        $this->y = $y;
    }

    public function infect()
    {
        $this->_infected = true;
    }

    public function cleared()
    {
        $this->_infected = false;
    }

    public function isInfected():bool
    {
        return $this->_infected;
    }

    public function hasWall($side)
    {
        foreach ($this->walls as $key => $wall) {
            if ($wall->getSide() == $side) {
                return true;
            }
        }

        return false;
    }

    public function addWall($side)
    {
        $this->walls[] = new Wall($side);
    }
}
