module models
import time

pub struct Boat {
	pub:
		id u32 [required]
		people []Person [required]
	
	good_people []Person
	bad_people []Person
}

pub fn (boat Boat) surf() {
	println("El bote $boat.id esta navegando")
	time.sleep(1000000000)
	println("El bote $boat.id llego a su destino ($boat.good_people.len) personas buenas ($boat.bad_people.len) personas malas")
}

pub fn new_boat(id u32, people []Person) ?Boat {
	good_people := people.filter(fn (person Person) bool {
		return person.person_type == PersonType.good
	})
	
	bad_people := people.filter(fn (person Person) bool {
		return person.person_type == PersonType.bad
	})

	if good_people.len < bad_people.len {
		return error("MANY_BAD_PEOPLE")
	}

	return Boat {
		id: id,
		people: people,
		good_people: good_people
		bad_people: bad_people
	}
}