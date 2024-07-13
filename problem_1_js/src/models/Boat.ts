import Person, { PersonType } from "./Person";

function sleep(ms: number): Promise<unknown> {
    return new Promise(res => setTimeout(res, ms));
}

export class ManyBadPeople extends Error {}

export default class Boat {
    public good_people: Array<Person>;
    public bad_people: Array<Person>;

    constructor (public id: number, public people: Array<Person>) {
        const good_people = people.filter((p) => p.type == PersonType.GOOD);
        const bad_people = people.filter((p) => p.type == PersonType.BAD);

        if (good_people.length < bad_people.length) {
            throw new ManyBadPeople()
        }

        this.good_people = good_people;
        this.bad_people = bad_people;
    }

    public surf() {
        console.log("Navegando...");
        sleep(2000).then(() => null);
        console.log(`El bote ${this.id} llego a su destino (${this.good_people.length}) personas buenas (${this.bad_people.length}) personas malas`)
    }
}