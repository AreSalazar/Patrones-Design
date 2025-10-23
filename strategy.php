<?php

/*Ejercicio 4:

Tenemos un sistema donde mostramos mensajes en distintos tipos de salida, como por consola, formato JSON y archivo TXT. 
Debes crear un programa donde se muestren todos estos tipos de salidas.

Para este propósito, aplica el patrón de diseño Strategy. */

// Creación de la estrategia base
interface EstrategiaSalida {
    public function mostrar($mensaje); //método que todas las estrategias deben tener, Cualquier clase que use esta interfaz sabrá cómo mostrar un mensaje
}

// Creación de estrategias individuales
class SalidaConsola implements EstrategiaSalida{
    public function mostrar($mensaje)
    {
        echo "Se muestra en consola: $mensaje\n";
    }
}

class SalidaJSON implements EstrategiaSalida{
    public function mostrar($mensaje)
    {
        echo json_encode(["mensaje" => $mensaje], JSON_PRETTY_PRINT). "\n"; //convierte el mensaje a formato JSON (usando json_encode) y lo muestra en consola
    }
}

class SalidaTXT implements EstrategiaSalida{
    public function mostrar($mensaje)
    {
        file_put_contents("mensaje.txt", $mensaje);
        echo "Mensaje guardado en 'mensaje.txt' \n"; //Usa file_put_contents() para guardar el mensaje en un archivo .txt
    }
}

// Creación de la clase CONTEXTO, no sabe cómo se mostrará el mensaje
class Mensaje{
    private $estrategia;

    public function setEstrategia(EstrategiaSalida $estrategia){ //Para ello existe una estrategia que lo hará, esta se usa para cambiar la estrategia (por ejemplo, consola, JSON o txt)
        $this->estrategia = $estrategia;
    }

    public function mostrar($mensaje){ //Llama al método mostrar() de la estrategia actual
        $this->estrategia->mostrar($mensaje); //El contexto “delegará” el trabajo de mostrar el mensaje a la estrategia elegida
    }
}

//Probando
echo "SALIDAS DE MENSAJE CON STRATEGY\n\n";

$mensaje = new Mensaje();

//Estrategia 1: Consola
$mensaje->setEstrategia(new SalidaConsola());
$mensaje->mostrar("Hablo desde la consola");

//Estrategia 2: JSON
$mensaje->setEstrategia(new SalidaJSON());
$mensaje->mostrar("Hablo desde formato JSON");

//Estrategia 3: Archivo TXT
$mensaje->setEstrategia(new SalidaTXT());
$mensaje->mostrar("Hablo desde el archivo TXT");

?>