<?php

namespace Tests\Entity;

use Szykra\StateMachine\StatefulInterface;

class Visit implements StatefulInterface
{
    const SCHEDULED = 1;
    const IN_PROGRESS = 2;
    const DONE = 3;
    const CANCELED = 4;

    private $status = self::SCHEDULED;

    public function getState()
    {
        return $this->status;
    }

    public function setState($state)
    {
        $this->status = $state;
    }
}