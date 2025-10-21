<?php

    class Cliente {

        public $nombre;
        private $numero;
        private $soportesAlquilados = [];
        private $numSoportesAlquilados = 0;
        private $maxAlquilerConcurrente;

        public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3) {
            $this->nombre = $nombre;
            $this->numero = $numero;
            $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
        }

        public function getNombre() {

            return $this->nombre;

        }

        public function setNombre($nombre)  {

            $this->nombre = $nombre;

        }

        public function getNumero() {

            return $this->numero;

        }

        public function getNumSoportesAlquilados() {

            return $this->numSoportesAlquilados;

        }

        public function tieneAlquilado(Soporte $s): bool {

            $comprobar = false;

            foreach ($this->soportesAlquilados as $soporte) {
                if ($soporte === $s) {
                    $comprobar = true;
                    break;
                }
            }

            return $comprobar;

        }

        public function alquilar(Soporte $s) : bool {

            $realizado = false;

            if ($this->tieneAlquilado($s)) {

                echo "No se puede alquilar, ya está alquilado.<br>";

            } else if ($this->numSoportesAlquilados == $this->maxAlquilerConcurrente) {

                echo "No se puede alquilar, máximo de alquileres concurrentes superados.<br>";
            
            } else {

                $realizado = true;

                echo "Agregado con éxito.<br>";

                $this->numSoportesAlquilados++;

                $this->soportesAlquilados[] = $s;

            }

            return $realizado;

        }

        public function devolver(int $numSoporte): bool {
        $realizado = false;

        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->getNumero() === $numSoporte) {
                unset($this->soportesAlquilados[$key]);
                $this->numSoportesAlquilados--;
                echo "Se ha podido eliminar.<br>";
                $realizado = true;
                break; // ya encontramos el soporte, salimos
            }
        }

        if (!$realizado) {
            echo "No se ha podido eliminar.<br>";
        }

            return $realizado;
    }

        public function listaAlquileres(): void {

            echo "El cliente " . $this->nombre . " tiene " . $this->numSoportesAlquilados . ".<br>";

            foreach ($this->soportesAlquilados as $soporte) {

                $soporte->muestraResumen();

            }

        }

        public function mostrarResumen() {

            echo "<br>Nombre: " . $this->getNombre() . "<br>";

            echo "Cantidad de alquileres: " . $this->getNumSoportesAlquilados() . "<br>";

        }
        
    }

?>