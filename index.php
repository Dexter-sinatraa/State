<?php

// Інтерфейс стану
interface State {
    public function handle(Context $context);
}

// Конкретні стани
class ConcreteStateA implements State {
    public function handle(Context $context) {
        echo "Handling request in State A.<br>";
        $context->setState(new ConcreteStateB());
    }
}

class ConcreteStateB implements State {
    public function handle(Context $context) {
        echo "Handling request in State B.<br>";
        $context->setState(new ConcreteStateA());
    }
}

// Контекст, який управляє станами
class Context {
    private $state;

    public function __construct() {
        $this->state = new ConcreteStateA();
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    public function request() {
        $this->state->handle($this);
    }
}

// Використання паттерна Стан
$context = new Context();

$context->request();
// Output: Handling request in State A.

$context->request();
// Output: Handling request in State B.

$context->request();
// Output: Handling request in State A.
