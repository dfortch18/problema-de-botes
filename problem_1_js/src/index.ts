import Person, { PersonType } from "./models/Person";
import Boat from "./models/Boat";
import readline from "readline";

function print_separator() {
    console.log("-------------------------------------------------------");
}

function main() {
    print_separator();

    let n_good: number = 0, n_bad: number = 0, n_boats: number = 0;

    let good_people: Array<Person> = [], bad_people: Array<Person> = [];

    const rl = readline.createInterface({ input: process.stdin, output: process.stdout });

    rl.question("Ingrese el número de personas buenas: ", (n_good_str) => {
        n_good = parseInt(n_good_str);

        rl.question("Ingrese el número de personas malas: ", (n_bad_str) => {
            n_bad = parseInt(n_bad_str);

            rl.question("Ingrese el número de botes: ", (n_boats_str) => {
                n_boats = parseInt(n_boats_str);
                rl.close();
            });
        });
    });

    rl.on("close", () => {
        for (let i = 0; i < n_good; i++) {
            good_people.push(new Person(`Person ${i}`, 18, PersonType.GOOD));
        }

        for (let i = 0; i < n_bad; i++) {
            bad_people.push(new Person(`Person ${i}`, 18, PersonType.BAD));
        }

        while (n_boats != 0) {
            let good_for_boat = Math.floor(n_good / n_boats), bad_for_boat = Math.floor(n_bad / n_boats);
            
            print_separator();
		    console.log(`N buenas: ${n_good}`);
		    console.log(`N malas: ${n_bad}`);
		    console.log(`Buenas x bote: ${good_for_boat}`);
		    console.log(`Malas x bote: ${bad_for_boat}`);
		    print_separator();

            let people: Array<Person> = [];

            people.push(...good_people.slice(good_for_boat));
            people.push(...bad_people.slice(bad_for_boat));
            console.log(people);

            let boat = new Boat(Math.random(), people);
            boat.surf();

            good_people = good_people.slice(-good_for_boat);
            bad_people = bad_people.slice(-bad_for_boat);

            n_good -= good_for_boat;
            n_bad -= bad_for_boat;

            n_boats -= 1;
        }
    });
}

if (require.main == module) {
    main();
}