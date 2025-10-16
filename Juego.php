<?php

    class Juego extends Soporte  {

        public $consola;
        private $minNumJugadores;
        private $maxNumJugadores;

        public function __construct($titulo,$numero,$precio,$consola,$minNumJugadores, $maxNumJugadores)
    {
        parent::__construct($titulo,$numero,$precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

        public function muestraJugadoresPosibles() {

            echo "El número de jugadores debe estar entre " . $this->minNumJugadores . " y " . $this->maxNumJugadores;

        }

        public function muestraResumen() {

        parent::muestraResumen();

        echo "Consola: " . $this->consola . "<br>";

        echo $this->muestraJugadoresPosibles();

        }

    }



?>