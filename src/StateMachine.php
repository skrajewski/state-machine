<?php

namespace Szykra\StateMachine;

use Szykra\StateMachine\Exception\StateNotFoundException;

class StateMachine implements StateMachineInterface
{

    /**
     * @var array
     */
    protected $states = [];

    /**
     * @var StatefulInterface
     */
    protected $statefulObject;

    /**
     * @inheritdoc
     */
    public function initialize(StatefulInterface $object)
    {
        $this->statefulObject = $object;
    }

    /**
     * @inheritdoc
     */
    public function run($transition)
    {
        $state = $this->getCurrentStateObject();
        $transition = $state->getTransition($transition);

        $this->statefulObject->setState($transition->getFinishState());
    }

    /**
     * @inheritdoc
     */
    public function can($transition)
    {
        return $this->getCurrentStateObject()->hasTransition($transition);
    }

    /**
     * @inheritdoc
     */
    public function isInitialized()
    {
        return $this->statefulObject !== null;
    }

    /**
     * @inheritdoc
     */
    public function addState(State $state)
    {
        $this->states[$state->getName()] = $state;
    }

    /**
     * @inheritdoc
     */
    public function getCurrentState()
    {
        return $this->statefulObject->getState();
    }

    /**
     * @inheritdoc
     */
    public function getAllStates()
    {
        return array_keys($this->states);
    }

    /**
     * Check if state machine has specific state
     *
     * @param $name
     * @return bool
     */
    protected function hasState($name)
    {
        return isset($this->states[$name]);
    }

    /**
     * Get specific state
     *
     * @param $name
     * @return mixed
     * @throws StateNotFoundException
     */
    protected function getState($name)
    {
        if (!$this->hasState($name)) {
            throw new StateNotFoundException();
        }

        return $this->states[$name];
    }

    /**
     * Get current state as object
     *
     * @return State
     * @throws StateNotFoundException
     */
    protected function getCurrentStateObject()
    {
        $stateName = $this->getCurrentState();

        return $this->getState($stateName);
    }

}
