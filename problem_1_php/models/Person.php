<?php

enum PersonType {
    case GOOD;
    case BAD;
}

class Person {
    public string $name;
    public int $age;
    public PersonType $person_type;

    public function __construct(string $name, int $age, PersonType $person_type)
    {
        $this->name = $name;
        $this->age = $age;
        $this->person_type = $person_type;
    }

    public function greet() {
        print "($this->name) esta saludando" . PHP_EOL;
    }

    public function say(string $message) {
        print "($this->name) dice: '$message'" . PHP_EOL;
    }
}