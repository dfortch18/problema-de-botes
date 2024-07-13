from typing import List
import time

class Persona:
    def __init__(self, name: str = None, age: int = None):
        self.name: str = (name if name is not None else f"{self.__class__.__name__} ({id(self)})")
        self.age: int = (age if name is not None else 18)

    def saludar(self, mensaje: str = None):
        if mensaje is not None:
            return print(f"{self.name} esta saludando y dice: \"{mensaje}\"")
        
        return print(f"{self.name} esta saludando")

    def __repr__(self) -> str:
        return self.name

class Buena(Persona):
    pass

class Mala(Persona):
    pass

class MuchasPersonasMalas(Exception):
    def __init__(self, n_buenas: int, n_malas: int):
        super().__init__(f"Hay muchas personas malas en el bote ({n_buenas}) buenas ({n_malas}) malas")

class Bote:
    def __init__(self, people: List[Persona]):
        self.personas_buenas = list(filter(lambda p: isinstance(p, Buena) == True, people))
        self.personas_malas = list(filter(lambda p: isinstance(p, Mala) == True, people))

        if len(self.personas_buenas) < len(self.personas_malas):
            raise MuchasPersonasMalas(len(self.personas_buenas), len(self.personas_malas))

    def navegar(self) -> bool:
        print(f"El bote {id(self)} Navegando...")
        time.sleep(2.0)
        print(f"El bote llego a su destino ({len(self.personas_buenas)}) personas buenas ({len(self.personas_malas)}) personas malas")

def print_separator():
    print("-------------------------------------------------------")

def main():
    print_separator()

    try:
        n_buenas = int(input("Ingrese el número de personas buenas: "))
        n_malas = int(input("Ingrese el número de personas malas: "))
        n_botes = int(input("Ingrese el número de botes: "))
    except ValueError:
        print("Malos valores ingresados!!")
        return print_separator()
    
    buenas = [Buena(f"Persona buena {i}") for i in range(0, n_buenas)]
    malas = [Mala(f"Persona mala {i}") for i in range(0, n_malas)]

    while n_botes != 0:
        buenas_por_bote = round(n_buenas / n_botes)
        malas_por_bote = round(n_malas / n_botes)

        print_separator()
        print(f"N buenas: {n_buenas}")
        print(f"N malas: {n_malas}")
        print(f"Buenas x bote: {buenas_por_bote}")
        print(f"Malas x bote: {malas_por_bote}")
        print_separator()

        bote = Bote([*buenas[:buenas_por_bote], *malas[:malas_por_bote]])
        bote.navegar()

        buenas = buenas[:-buenas_por_bote]
        malas = malas[:-malas_por_bote]
        n_buenas -= buenas_por_bote
        n_malas -= malas_por_bote

        n_botes -= 1

    print_separator()

if __name__ == "__main__":
    main()