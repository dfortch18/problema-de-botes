import models { Person, new_person, new_boat, new_boat, PersonType }
import os { input }
import rand

pub fn print_separator() {
	println("-------------------------------------------------------")
}

fn main() {
	print_separator()

	mut n_good := input("Ingrese el número de personas buenas: ").int()
	mut n_bad := input("Ingrese el número de personas malas: ").int()
	mut n_boats := input("Ingrese el número de botes: ").int()

	mut good_people := []Person{}
	mut bad_people := []Person{}

	for i in 0..n_good {
		good_people << new_person("Person $i", 18, PersonType.good)
	}

	for i in 0..n_bad {
		bad_people << new_person("Person $i", 18, PersonType.bad)
	}

	for {
		if n_boats == 0 {
			break
		}

		good_for_boat := n_good / n_boats
		bad_for_boat := n_bad / n_boats

		print_separator()
		println("N buenas: $n_good")
		println("N malas: $n_bad")
		println("Buenas x bote: $good_for_boat")
		println("Malas x bote: $bad_for_boat")
		print_separator()

		mut people := []Person{}

		people << good_people[..good_for_boat]
		people << bad_people[..bad_for_boat]

		boat := new_boat(rand.u32(), people) or {
			panic(err)
		}
		boat.surf()

		good_people = good_people#[..-good_for_boat]
		bad_people = bad_people#[..-bad_for_boat]

		n_good -= good_for_boat
		n_bad -= bad_for_boat

		n_boats -= 1
	}

	println(good_people)
}