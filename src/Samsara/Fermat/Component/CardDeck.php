<?php

namespace Samsara\Fermat\Component;

use Ds\Vector;
use RandomLib\Factory;
use Samsara\Exceptions\UsageError\IntegrityConstraint;
use Samsara\Fermat\Types\Card;

class CardDeck
{

    private $deck;
    private $used;
    private $size;

    public function __construct(array $cards)
    {

        $this->deck = new Vector();
        $this->used = new Vector();

        foreach ($cards as $card) {
            $this->deck->push(new Card($card[0], $card[1], $card[2]));
        }

        $this->size = $this->deck->count();

    }

    /**
     * Uses the Fisher-Yates shuffle algorithm
     *
     * @return $this
     */
    public function shuffle()
    {

        $fullDeck = $this->deck->merge($this->used);

        $this->deck = $fullDeck;
        $this->used = new Vector();

        $randFactory = new Factory();
        $generator = $randFactory->getHighStrengthGenerator();

        for ($i = ($this->size-1);$i > 0;$i--) {
            $j = $generator->generateInt(0, $i);
            $temp = $this->deck->get($i);
            $this->deck->set($i, $this->deck->get($j));
            $this->deck->set($j, $temp);
        }

        unset($temp);

        return $this;

    }

    public function deal($num = 1)
    {

        if ($num < 1) {
            throw new IntegrityConstraint(
                'Can only deal at least one card',
                'Deal at least one card at a time',
                'The deal() method must have a positive integer for $num'
            );
        }

        for ($i = 0;$i < $num;$i++) {
            $card = $this->deck->pop();

            $this->used->push($card);
        }

        return $card;

    }

}