<?php

require_once "Entity/Visit.php";

use Szykra\StateMachine\State;
use Szykra\StateMachine\StateMachine;
use Szykra\StateMachine\Transition;
use Tests\Entity\Visit;


class StateMachineTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var StateMachine
     */
    protected $machine;

    public function setUp()
    {
        $this->machine = new StateMachine();

        $stateScheduled = new State(Visit::SCHEDULED);
        $stateScheduled->addTransition('do', Visit::SCHEDULED, Visit::IN_PROGRESS);

        $stateProgress = new State(Visit::IN_PROGRESS);
        $stateProgress->putTransition(new Transition('reset', Visit::IN_PROGRESS, Visit::SCHEDULED));

        $this->machine->addState($stateScheduled);
        $this->machine->addState($stateProgress);
    }

    public function test_change_state()
    {
        $visit = new Visit();

        $this->machine->initialize($visit);
        $this->machine->run('do');

        $this->assertEquals(Visit::IN_PROGRESS, $visit->getState());
    }

    public function test_can_change_state()
    {
        $visit = new Visit();

        $this->machine->initialize($visit);
        $result = $this->machine->can('do');

        $this->assertTrue($result);
    }

    public function test_cant_change_state()
    {
        $visit = new Visit();

        $this->machine->initialize($visit);

        $result = $this->machine->can('done');

        $this->assertFalse($result);
    }

    /**
     * @expectedException Szykra\StateMachine\Exception\TransitionNotFoundException
     */
    public function test_run_invalid_transition()
    {
        $visit = new Visit();

        $this->machine->initialize($visit);

        $this->machine->run('done');
    }

}
