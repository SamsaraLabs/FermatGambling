<?php

namespace Samsara\Fermat\Types;

class Card
{

    private $value;
    private $suit;
    private $numericalValue;

    public function __construct($value, $suit, $numericalValue)
    {

        $this->value = $value;
        $this->suit = $suit;
        $this->numericalValue = $numericalValue;

    }

    public function getValue()
    {

        return $this->value;

    }

    public function getSuit()
    {

        return $this->suit;

    }

    public function getNumericalValue()
    {

        return $this->numericalValue;

    }

}