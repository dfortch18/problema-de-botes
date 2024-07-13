<?php
require_once "models/Person.php";
require_once "models/Boat.php";

function print_separator() {
    print "-------------------------------------------------------" . PHP_EOL;
}

function main() {
    print_separator();

    $n_good = (int) readline("Ingrese el número de personas buenas: ");
    $n_bad = (int) readline("Ingrese el número de personas malas: ");
    $n_boats = (int) readline("Ingrese el número de botes: ");

    $good_people = [];
    $bad_people = [];

    
    foreach (range(0, $n_good) as $i) {
        array_push($good_people, new Person("Person $i", 18, PersonType::GOOD));
    }

    foreach (range(0, $n_bad) as $i) {
        array_push($bad_people, new Person("Person $i", 18, PersonType::BAD));
    }

    while ($n_boats != 0) {
        $good_for_boat = round($n_good / $n_boats);
        $bad_for_boat = round($n_bad / $n_boats);

        print_separator();
        print "N buenas: $n_good" . PHP_EOL;
        print "N malas: $n_bad" . PHP_EOL;
        print "Buenas x bote: $good_for_boat" . PHP_EOL;
        print "Malas x bote:  $bad_for_boat" . PHP_EOL;
        print_separator();

        $people = [];

        foreach (array_slice($good_people, -$good_for_boat) as $p) {
            array_push($people, $p);
        }

        foreach (array_slice($bad_people, -$bad_for_boat) as $p) {
            array_push($people, $p);
        }

        $boat = new Boat(random_int(0, 1000), $people);
        $boat->surf();

        $good_people = array_slice($good_people, $good_for_boat);
        $bad_people = array_slice($bad_people, $bad_for_boat);

        $n_good -= $good_for_boat;
        $n_bad -= $bad_for_boat;

        $n_boats -= 1;
    }
}

main();