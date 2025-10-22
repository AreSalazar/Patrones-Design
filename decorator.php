<?php

/*Ejercicio 3:

Crear un programa donde sea posible añadir diferentes armas a ciertos personajes de videojuegos. 
Debes utilizar al menos dos personajes para este ejercicio.

Para llevar a cabo esta tarea, aplica el patrón de diseño Decorator. */

// Interface base para la estructura común de todos los personajes y decoradores que deben de tener
interface Avatar{
    public function atacar();
}

// Creación de las clases Mago y Valkiria que serán los personajes base
class Mago implements Avatar{
    public function atacar()
    {
        return "El mago lanza una fireball";
    }
}

class Valquiria implements Avatar{
    public function atacar()
    {
        return "La valquiria da un golpe poderoso";
    }
}

// Creación del decorador BASE
class ArmaDecorator implements Avatar{ //Tanto los personajes como el arma implementan la interfaz Avatar
    protected $personaje;

    public function __construct(Avatar $personaje)
    {
        $this->personaje = $personaje;
    }

    public function atacar()
    {
        return $this->personaje->atacar(); //El decorador pasa al personaje base
    }
}

// Creación de los decoradores individuales (armas)
class Varita extends ArmaDecorator{
    public function atacar()
    {
        return $this->personaje->atacar() .  " con su varita"; //método atacar() + una acción extra
    }
}

class Hacha extends ArmaDecorator{
    public function atacar()
    {
        return $this->personaje->atacar() . " con su hacha"; //método atacar() + una acción extra
    }
}

//Creacion de los personajes normalmente
$mago = new Mago();
$valquiria = new Valquiria();

//Luego se envuelven con un decorador que les agrega un arma
$magoVarita = new Varita($mago);
$valquiriaHacha = new Hacha(($valquiria));


echo $magoVarita->atacar() . "\n";
echo $valquiriaHacha->atacar() . "\n";

?>