<?php

namespace Szykra\StateMachine;

class Transition
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $startState;

    /**
     * @var string
     */
    protected $finishState;

    /**
     * @param $name
     * @param $startState
     * @param $finishState
     */
    public function __construct($name, $startState, $finishState)
    {
        $this->name = $name;
        $this->startState = $startState;
        $this->finishState = $finishState;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStartState()
    {
        return $this->startState;
    }

    /**
     * @return string
     */
    public function getFinishState()
    {
        return $this->finishState;
    }

}
