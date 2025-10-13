<?php

Class Soporte {

    public $titulo;
    protected $numero;
    private $precio;

    public function __construct($titulo,  $numero, $precio)
    {
        
        $this->titulo = $titulo;
        $this->numero = $numero;
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

        echo $this->titulo . "<br>";

        echo "Numero: " . $this->numero . "<br>";

        echo "Precio con IVA: " . $this->getPrecioConIva() . "<br>";

    }

}

?>