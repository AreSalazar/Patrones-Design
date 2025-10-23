<?php

/*Ejercicio 2:

Estamos trabajando con distintas versiones de sistemas operativos Windows 7 y Windows 10. 
Al compartir archivos como Word, Excel, Power Point, surgen problemas al abrirlos en Windows 10 debido a la falta de compatibilidad con la versión Windows 7. 
Debes crear un programa donde Windows 10 pueda aceptar estos archivos independientemente de que sean de versiones anteriores.

Para ello, aplica el patrón de diseño Adapter. */


// Interfaz moderna que Windows 10 espera usar
interface SistemaOperativo{
    public function abrirArchivo($tipoArchivo); //Cualquier otro SO que sea moderno deberá usar este método abrirArchivo($tipoArchivo)
}

// Windows 7 representa el SO viejo
class Windows7 {
    public function abrirArchivoAntiguo($formato){ // El método abrirArchivoAntiguo() no coincide con el método moderno abrirArchivo()
        return "Abriendo archivo de tipo $formato usando compatibilidad de Windows 7"; // Por eso W10 no puede usar este método directamente
    }
}

// Windows 10 representa el SO moderno, por lo que sí puede usar la interface moderna
class Windows10 implements SistemaOperativo{
    public function abrirArchivo($tipoArchivo) // Sí puede usar su método
    {
        return "Archivo de tipo $tipoArchivo abierto correctamente en Windows 10"; // Sí puede abrir sus archivos
    }
}

// Creando el ADAPTADOR que permite que Windows 10 use archivos de Windows 7
// Este adaptador se comportará “como” un Windows 10, pero por dentro usará la lógica de Windows 7
class AdapterWindows10 implements SistemaOperativo{
    private $windows7; //Secrea una instancia de la clase vieja y es private para proteger la información y por el principio de encapsulación

    public function __construct(Windows7 $windows7) //Recibe  parámetro un objeto de tipo Windows7, para usarse dentro del adaptador
    {// es decir, cuando creamos el adaptador, le entregamos una versión vieja de Windows7, y el adaptador sabrá cómo usarla
        $this->windows7 = $windows7;// el adaptador ahora “tiene acceso” a los métodos antiguos de Windows7
    }

    public function abrirArchivo($tipoArchivo) //método exigente de la interface SistemaOperativo, que W7 no lo tiene
    {
        //Aquí se adapta el archivo moderno al método antiguo
        return $this->windows7->abrirArchivoAntiguo($tipoArchivo); // Traduce el archivo moderno ($tipoArchivo) para abrirlo en el viejo
    }
}

//Probando
echo "Simulación de compatibilidad de Archivos\n\n";

// Creación de una instancia del sistema antiguo
$windows7 = new Windows7();

// Creación de un adaptador para que W10 entienda W7
$adaptadorcito = new AdapterWindows10($windows7);

// Se usa el adaptador como si fuera W10
echo $adaptadorcito->abrirArchivo("Word") . "\n";
echo $adaptadorcito->abrirArchivo("Excel") . "\n";
echo $adaptadorcito->abrirArchivo("PPT") . "\n";


?>