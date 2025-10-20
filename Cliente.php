<?php

    class Cliente {

        public $nombre;
        private $numero;
        private $soportesAlquilados;
        private $numSoportesAlquilados;
        private $maxAlquilerConcurrente;

        public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3) {
            $this->nombre = $nombre;
            $this->numero = $numero;
            $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
            $this->numSoportesAlquilados = 0;
            $this->soportesAlquilados = [];
        }

        public function getNombre() {

            return $this->nombre;

        }

        public function setNombre($nombre)  {

            $this->nombre = $nombre;

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

                echo "No se puede alquilar, ya está alquilado.";

            } else if ($this->numSoportesAlquilados == $this->maxAlquilerConcurrente) {

                echo "No se puede alquilar, máximo de alquileres concurrentes superados.";
            
            } else {

                $realizado = true;

                echo "Agregado con éxito.";

                $this->numSoportesAlquilados++;

                $this->soportesAlquilados[] = $s;

            }

            return $realizado;

        }

        public function devolver(int $numSoporte): bool {

            $realizado = false;

            $keyABorrar = null;

            foreach ($this->soportesAlquilados as $soporte) {
                
                if ($soporte->getNumero() === $numSoporte) {

                    $keyABorrar = $soporte;

                }

            }

            if ($keyABorrar != null) {

                unset($this->soportesAlquilados, $keyABorrar);

                echo "Se ha podido eliminar.";

                $realizado = true;

            } else {

                echo "No se ha podido eliminar.";

            }

            return $realizado;

        }

        public function listarAlquileres(): void {

            echo "El cliente " . $this->nombre . " tiene " . $this->numSoportesAlquilados . ".";

            foreach ($this->soportesAlquilados as $soporte) {

                $soporte->muestraResumen();

            }

        }

        public function mostrarResumen() {

            echo "Nombre: " . $this->getNombre();

            echo "Cantidad de alquileres: " . $this->getNumSoportesAlquilados();

        }
        
    }

?>