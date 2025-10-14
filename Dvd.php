<?php 
 class Dvd extends Soporte
 {
    public $idiomas;
    private $formatoPantalla;

    public function __construct( $titulo,$numero,$precio,$idiomas,$formatoPantalla)
    {
        parent::__construct($titulo,$numero,$precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }
 }
?>