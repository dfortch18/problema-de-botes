module models

pub enum PersonType {
	good = 0
	bad = 1
}

pub struct Person {
	pub:
		name string [required]
		age int [required]
		person_type PersonType [required]
}

pub fn (person Person) greet() {
	println("$person.name esta saludando")
}

pub fn (person Person) say(message string) {
	println("$person.name dice: $message")
}

pub fn new_person(name string, age int, person_type PersonType) Person {
	return Person {
		name: name,
		age: age
		person_type: person_type
	}
}