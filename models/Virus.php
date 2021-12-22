<?php
namespace app\models;

/**
 *
 */
class Virus
{
    public array $list;

    public $regions = [];

    public function __construct(array $list)
    {
        $this->list = $list;
        $this->createRegions();
    }

    public function createRegions()
    {
        foreach ($this->list as $y => $row) {
            foreach ($row as $x => $item) {
                $this->regions[] = new Region($x, $y, $this->list[$y][$x] == 1);
            }
        }
    }

    public function clear()
    {
        $count = 0;
        for ($i=0; $i < count($this->regions); $i++) {
            $region = $this->regions[$i];
            if ($region->isInfected() && $region->controlled == false) {
                $count += $this->drawBorder($region);
                $this->infectWiruses();
                $i=-1;
            }
        }
        return $count;
    }

    public function clearSpreads()
    {
        foreach ($this->regions as $key => $region) {
            if ($region->isInfected() && $region->controlled == false) {
                $region->spreaded = false;
            }
        }
    }

    public function infectWiruses()
    {
        $this->clearSpreads();
        foreach ($this->regions as $key => $region) {
            if ($region->isInfected() && $region->controlled == false && $region->spreaded == false) {
                $r = $this->findRegion($region->x-1, $region->y);
                if ($r != null && $r->isInfected() == false) {
                    $r->infect();
                    $r->spreaded = true;
                }
                $r = $this->findRegion($region->x+1, $region->y);
                if ($r != null && $r->isInfected() == false) {
                    $r->infect();
                    $r->spreaded = true;
                }
                $r = $this->findRegion($region->x, $region->y-1);
                if ($r != null && $r->isInfected() == false) {
                    $r->infect();
                    $r->spreaded = true;
                }
                $r = $this->findRegion($region->x, $region->y+1);
                if ($r != null && $r->isInfected() == false) {
                    $r->infect();
                    $r->spreaded = true;
                }
            }
        }
    }

    public function drawBorder($region)
    {
        $borderCount = 0;
        $region->controlled = true;
        if (!$region->hasWall(Wall::TYPE_LEFT)) {
            $aRegion = $this->findRegion(($region->x-1), $region->y);
            if ($aRegion != null && $aRegion->controlled == false) {
                if ($aRegion->isInfected()) {
                    $borderCount += $this->drawBorder($aRegion);
                } else {
                    $region->addWall(Wall::TYPE_LEFT);
                    $borderCount++;
                }
            }
        }

        if (!$region->hasWall(Wall::TYPE_TOP)) {
            $aRegion = $this->findRegion($region->x, ($region->y)-1);
            if ($aRegion != null && $aRegion->controlled == false) {
                if ($aRegion->isInfected()) {
                    $borderCount += $this->drawBorder($aRegion);
                } else {
                    $region->addWall(Wall::TYPE_TOP);
                    $borderCount++;
                }
            }
        }

        if (!$region->hasWall(Wall::TYPE_BOTTOM)) {
            $aRegion = $this->findRegion($region->x, ($region->y)+1);
            if ($aRegion != null && $aRegion->controlled == false) {
                if ($aRegion->isInfected()) {
                    $borderCount += $this->drawBorder($aRegion);
                } else {
                    $region->addWall(Wall::TYPE_BOTTOM);
                    $borderCount++;
                }
            }
        }

        if (!$region->hasWall(Wall::TYPE_RIGHT)) {
            $aRegion = $this->findRegion(($region->x)+1, $region->y);
            if ($aRegion != null && $aRegion->controlled == false) {
                if ($aRegion->isInfected()) {
                    $borderCount += $this->drawBorder($aRegion);
                } else {
                    $region->addWall(Wall::TYPE_RIGHT);
                    $borderCount++;
                }
            }
        }

        return $borderCount;
    }

    public function findRegion($x, $y)
    {
        foreach ($this->regions as $key => $region) {
            if ($region->x == $x && $region->y == $y) {
                return $region;
            }
        }

        return null;
    }
}
