<?php 
 class Dvd extends Soporte
 {
    public $idiomas;
    private $formatoPantalla;

    public function __construct($titulo,$numero,$precio,$idiomas,$formatoPantalla)
    {
        parent::__construct($titulo,$numero,$precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    public function muestraResumen() {

        parent::muestraResumen();

        echo "Idiomas: " . $this->idiomas . "<br>";

        echo "Formato de Pantalla: " . $this->formatoPantalla . "<br>";

    }
 }

?>