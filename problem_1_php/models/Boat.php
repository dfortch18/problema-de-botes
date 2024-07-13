<?php
require_once "Person.php";

class ManyBadPeople extends Error {
    public function __construct(int $n_good, int $n_bad)
    {
        parent::__construct("Hay muchas personas malas en el bote ($n_good) buenas ($n_bad) malas");
    }
}

class Boat {
    public int $id;
    public array $people;
    public array $good_people;
    public array $bad_people;

    public function __construct(int $id, array $people)
    {
        $this->id = $id;
        $this->people = $people;

        $good_people = array_filter($people, function (Person $p) {
            return $p->person_type == PersonType::GOOD;
        });

        $bad_people = array_filter($people, function (Person $p) {
            return $p->person_type == PersonType::BAD;
        });

        if (sizeof($good_people) < sizeof($bad_people)) {
            throw new ManyBadPeople(sizeof($good_people), sizeof($bad_people));
        }

        $this->good_people = $good_people;
        $this->bad_people = $bad_people;
    }

    public function surf() {
        print "EL bote $this->id esta navegando..." . PHP_EOL;
        sleep(2);
        print "El bote $this->id llego a su destino (" . sizeof($this->good_people) . ") personas buenas (" . sizeof($this->bad_people) . ") personas malas" . PHP_EOL;
        sleep(1);
    }
}