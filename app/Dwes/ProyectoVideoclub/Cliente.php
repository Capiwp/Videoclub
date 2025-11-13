<?php

namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;

    class Cliente {

        public $nombre;
        private static $contador = 0;
        private $numero;
        private $soportesAlquilados = [];
        private $numSoportesAlquilados = 0;
        private $maxAlquilerConcurrente;

        public function __construct($nombre, $maxAlquilerConcurrente = 3) {
            $this->nombre = $nombre;
            self::$contador++;
            $this->numero = self::$contador;
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

        public function alquilar(Soporte $s) : Cliente {

            if ($this->tieneAlquilado($s)) {

                throw new SoporteYaAlquiladoException("El soporte ya está alquilado.");

            } else if ($this->numSoportesAlquilados == $this->maxAlquilerConcurrente) {

                throw new CupoSuperadoException("El cliente '$this->nombre' ha superado el cupo de alquileres.");
            
            } else {

                echo "Agregado con éxito.<br>";

                $this->numSoportesAlquilados++;

                $this->soportesAlquilados[] = $s;

            }

            return $this;

        }

        public function devolver(int $numSoporte): bool {
        $realizado = false;

        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->getNumero() === $numSoporte) {
                unset($this->soportesAlquilados[$key]);
                $this->numSoportesAlquilados--;
                echo "Se ha podido eliminar.<br>";
                $realizado = true;
                break;
            }
        }

        if (!$realizado) {
            echo "No se ha podido eliminar.<br>";
        }

            return $realizado;
    }

        public function listaAlquileres(): void {

            echo "<br>El cliente " . $this->nombre . " tiene " . $this->numSoportesAlquilados . " alquileres, los cuáles son:<br>";

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