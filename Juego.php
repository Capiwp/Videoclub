<?php

    require_once 'Soporte.php';

    class Juego extends Soporte  {

        public $consola;
        private $minNumJugadores;
        private $maxNumJugadores;

        public function __construct($titulo,$precio,$consola,$minNumJugadores, $maxNumJugadores)
    {
        parent::__construct($titulo,$precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

        public function muestraJugadoresPosibles() {

            echo "El número de jugadores debe estar entre " . $this->minNumJugadores . " y " . $this->maxNumJugadores . "<br>";

        }

        public function muestraResumen() {

        parent::muestraResumen();

        echo "Consola: " . $this->consola . "<br>";

        echo $this->muestraJugadoresPosibles();

        }

    }



?>