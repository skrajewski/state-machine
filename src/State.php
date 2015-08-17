<?php

namespace Szykra\StateMachine;

use Szykra\StateMachine\Exception\TransitionNotFoundException;

class State
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $transitions = [];

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param Transition $transition
     */
    public function putTransition(Transition $transition)
    {
        $this->transitions[$transition->getName()] = $transition;
    }

    /**
     * @param $name
     * @param $startState
     * @param $finishState
     */
    public function addTransition($name, $startState, $finishState)
    {
        $transition = new Transition($name, $startState, $finishState);

        $this->putTransition($transition);
    }

    /**
     * Check if state has transition specific transition
     *
     * @param $name
     * @return bool
     */
    public function hasTransition($name)
    {
        return isset($this->transitions[$name]);
    }

    /**
     * Get specific transition from state
     *
     * @param $name
     * @return mixed
     * @throws TransitionNotFoundException
     */
    public function getTransition($name)
    {
        if (!$this->hasTransition($name)) {
            throw new TransitionNotFoundException();
        }

        return $this->transitions[$name];
    }

    /**
     * Get available transition names
     *
     * @return array
     */
    public function getTransitionsList()
    {
        return array_keys($this->transitions);
    }

    /**
     * Get state name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get all transition array
     *
     * @return array
     */
    public function getTransitions()
    {
        return $this->transitions;
    }

}