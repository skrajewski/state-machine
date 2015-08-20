Finite State Machine
============================

[Finite State Machine](https://en.wikipedia.org/wiki/Finite-state_machine) implementation in PHP

## Installation

### Install via composer
Add dependency to your `composer.json` file and run `composer update`.

```json
"szykra/state-machine": "~0.1.0"
```

or just run

```sh
composer require szykra/state-machine
```

## Usage

### Prepare your entity to be stateful

Your entity should implements interface `StatefulInterface`. It requires two new methods

- `public function getState();`
- `public function setState($state);`

Of course you should add new property named e.g. _state_.

### Configure a _StateMachine_ by adding _States_ and _Transitions_

To control your entity by _StateMachine_ you have to define:

- States
- Transitions between States

#### State

State object simply represents a state. It has name and list of available transitions.

```php
$stateDraft = new State('draft');
$statePublished = new State('published');
```

#### Transition

Transition is like single action which someone performs on an object. It means transition from one state to another state.

```php
$stateDraft->addTransition('publish', 'draft', 'published');

$transitionReject = new Transition('reject', 'published', 'rejected');
$statePublished->putTransition($transitionReject);
```

Each state has own transitions so available transitions depend on the current state of object.

#### StateMachine

StateMachine is a controller used to change state of stateful object. First you should create a _StateMachine_ object and set up it by adding a valid _States_.

```php
$stateMachine = new StateMachine();

// api inconsistent, should called putState
$stateMachine->addState($stateDraft);
$stateMachine->addState($statePublished);
```

### Initialize a State Machine

When your _StateMachine_ is ready you could initialize it by __Stateful Object__.

```php
$document = new Document();
$stateMachine->initialize($document);
```

Now you could change state of `$document` by `$stateMachine`. To check if transition can be performed use the `can($transition)` method, e.g. if current state of `$document` is _draft_ the results will be as follows

```php
$stateMachine->can('publish'); // true
$stateMachine->can('reject'); // false
```

To change state of object you should use `run($transition)` method. If transition not exists `TransitionNotFoundException` will be thrown.

```php
echo $document->getState();    // draft
$stateMachine->run('publish');
echo $document->getState();    // published
```

> If you want to see a complete example please see _tests/_ directory.

## To do
- [ ] Ability to setup callbacks before/after change states
- [ ] List all states
- [ ] List all transitions
- [ ] Add configurable loader to StateMachine
- [ ] Add configurable conditionals to transitions

## License
The MIT License. Copyright &copy; 2015 by Szymon Krajewski
