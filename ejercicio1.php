<?php

/*Ejercicio 1:

Crear un programa que contenga dos personajes: "Esqueleto" y "Zombi". Cada personaje tendrá una lógica diferente en sus ataques y velocidad. La creación de los personajes dependerá del nivel del juego:

- En el nivel fácil se creará un personaje "Esqueleto".
- En el nivel difícil se creará un personaje "Zombi".

Debes aplicar el patrón de diseño Factory para la creación de los personajes. */


// Creación de interface Personaje para definir métodos comunes
interface Personaje
{
    public function atacar(); // Todos los métodos de una interfaz deben ser públicos, porque son contratos públicos
    public function mover();
}

// Creacón de las clases concretas que hace la interfaz
class Esqueleto implements Personaje
{

    public function atacar()
    {
        return "El esqueleto maincra te lanza flechas.";
    }

    public function mover()
    {
        return "El esqueleto maincra corre hacia ti.";
    }
}

class Zombie implements Personaje
{

    public function atacar()
    {
        return "El zombie maincra te está atacando.";
    }

    public function mover()
    {
        return "El zombie maincra te persigue.";
    }
}

// Creación del Factory o Fábrica para crear personajes de acuerdo al nivel
class PersonajeFctory // es un taller para crear personajes
{
    public static function crearPersonaje($nivel) //El método static es útil cuando una clase solo tiene funciones auxiliares (como crear objetos)
    {
        if ($nivel === "facil") {
            return new Esqueleto();
        } else if ($nivel === "dificil") {
            return new Zombie();
        } else {
            throw new Exception("Nivel no válido");
        }
    }
}

try {
    $nivel = "dificil";

    // Se usa la fábrica para crear al personaje
    $personaje = PersonajeFctory::crearPersonaje($nivel); // Llamada válida gracias a que el método es estático, porlo que no se usa:
    /*$factory = new PersonajeFactory();
    $personaje = $factory->crearPersonaje("dificil");*/

    // Se muestra la info del PJ
    echo "Nivel del juego: $nivel\n";
    echo $personaje->atacar() . "\n"; //el operador . concatena (une) cadenas. atacar() + \n
    echo $personaje->mover() . "\n";

} catch (Exception $errorMessage) {
    echo "Error: " . $erroMessage->getMessage(); //une la etiqueta "Error: " con el mensaje real de la excepción
}

?>