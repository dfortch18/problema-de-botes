export enum PersonType {
    GOOD,
    BAD
}

export default class Person {
    constructor (public name: string, public age: number, public type: PersonType) {}

    public greet() {
        console.log(`${this.name} esta saludando`);
    }

    public say(message: string) {
        console.log(`${this.name} dice: ${message}`);
    }
}