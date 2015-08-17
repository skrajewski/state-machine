<?php

namespace Tests\Entity;

use Szykra\StateMachine\StatefulInterface;

class Document implements StatefulInterface
{

    private $state;

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }
}