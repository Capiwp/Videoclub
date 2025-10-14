<?php   
    class CintaVideo extends Soporte
    {
        private $duracion;

        public function __construct($titulo,  $numero, $precio,$duracion)
    {
        parent::__construct($titulo, $numero, $precio, $duracion);
        $this -> duracion = $duracion;
    }
    public function mostrarInfo()
    {
        parent::muestraResumen();
        echo "Duración". $this -> duracion ."<br>";
    }
    }
?>