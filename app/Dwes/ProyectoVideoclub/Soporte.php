<?php

namespace Dwes\ProyectoVideoclub;

Class Soporte {

    public $titulo;
    protected $numero;
    private $precio;
    private static $contador = 0;
    public bool $alquilado = false;


    public function __construct($titulo, $precio)
    {
        
        $this->titulo = $titulo;
        self::$contador++;
        $this->numero = self::$contador;
        $this->precio = $precio;

    }

    public function getPrecio() {

        return $this->precio;

    }

    public function getPrecioConIva() {

        return $this->precio + ($this->precio/100 * 21);

    }

    public function getNumero() {

        return $this->numero;

    }

    public function muestraResumen() {

        echo "<br>Título: " . $this->titulo . "<br>";

        echo "Numero: " . $this->numero . "<br>";

        echo "Precio con IVA: " . $this->getPrecioConIva() . "<br>";

    }

}

?>