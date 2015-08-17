<?php

namespace Szykra\StateMachine;

interface StateMachineInterface
{

    /**
     * Apply new state to controlled object
     *
     * @param $transition
     */
    public function run($transition);

    /**
     * Check if transition could be applied
     *
     * @param $transition
     * @return bool
     */
    public function can($transition);

    /**
     * Check if state machine is initialized
     *
     * @return bool
     */
    public function isInitialized();

    /**
     * Initialize FSM by Stateful Object
     *
     * @param StatefulInterface $object
     */
    public function initialize(StatefulInterface $object);

    /**
     * Get current state from controlled object
     *
     * @return string
     */
    public function getCurrentState();

    /**
     * Add new state to FSM
     *
     * @param State $state
     */
    public function addState(State $state);

    /**
     * Get all states from FSM
     *
     * @return array
     */
    public function getAllStates();

}