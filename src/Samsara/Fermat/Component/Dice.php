<?php

namespace Samsara\Fermat\Component;

use RandomLib\Factory;
use Samsara\Fermat\Numbers;

class Dice
{
    private $sides;
    private $rollHistory = [];

    public function __construct($sides = 6)
    {

        $this->sides = $sides;

    }

    public function roll()
    {

        $randFactory = new Factory();
        $generator = $randFactory->getHighStrengthGenerator();

        $value = $generator->generateInt(1, $this->sides);
        $roll = Numbers::make(Numbers::IMMUTABLE, $value);

        $this->rollHistory[] = $roll;

        return $roll;

    }

    public function rollHistory()
    {

        return $this->rollHistory;

    }

}