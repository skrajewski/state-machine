<?php

namespace Szykra\StateMachine;

interface StatefulInterface
{

    public function getState();

    public function setState($state);

}