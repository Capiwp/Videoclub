<?php

namespace Dwes\ProyectoVideoclub;

    include_once 'CintaVideo.php';
    include_once 'Dvd.php';
    include_once 'Juego.php';
    include_once 'Cliente.php';

    class Videoclub {

        private $nombre;
        private $productos = [];
        private $numProductos;
        private $socios = [];
        private $numSocios;

        public function __construct($nombre)
        {

            $this->nombre = $nombre;
            
        }
        
        private function incluirProducto(Soporte $s) {

            $this->productos[] = $s;

        }

        public function incluirCintaVideo($titulo, $precio, $duracion) {

            $cintavideo = new CintaVideo($titulo, $precio, $duracion);

            $this->incluirProducto($cintavideo);

            echo "Cinta de video añadido correctamente<br>";


        }

        public function incluirDvd($titulo, $precio, $idiomas, $formatoPantalla) {

            $dvd = new Dvd($titulo, $precio, $idiomas, $formatoPantalla);

            $this->incluirProducto($dvd);

            echo "DVD añadido correctamente<br>";

        }

        public function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ) {

            $juego = new Juego($titulo, $precio, $consola, $minJ, $maxJ);

            $this->incluirProducto($juego);
            
            echo "Juego añadido correctamente<br>";

        }

        public function incluirSocio($nombre, $maxAlquileresConcurrentes = 3) {

            $cliente = new Cliente($nombre, $maxAlquileresConcurrentes);

            $this->socios[] = $cliente;

            echo "Cliente añadido correctamente<br>";


        }

        public function listarProductos() {

            echo "<br>---PRODUCTOS---<br>";

            foreach ($this->productos as $producto) {
                
                $producto->muestraResumen();

            }

        }

        public function listarSocios() {

            echo "<br>---CLIENTES---<br>";


            foreach ($this->socios as $socio) {
                
                $socio->mostrarResumen();

            }

        }

        public function alquilaSocioProducto($numeroCliente, $numeroSoporte) {

            $socioEncontrado = null;
            $soporteEncontrado = null;

            foreach ($this->socios as $socio) {
                
                if ($socio->getNumero() == $numeroCliente) {

                    $socioEncontrado = $socio;

                    break;

                }

            }

            foreach ($this->productos as $producto) {
                
                if ($producto->getNumero() == $numeroSoporte) {

                    $soporteEncontrado = $producto;

                    break;
                    
                }

            }

            if ($soporteEncontrado && $socioEncontrado) {

                $socioEncontrado->alquilar($soporteEncontrado);


            } else {


            }

        }

        public function verAlquileresUsuarios() {

            foreach ($this->socios as $socio) {

                $socio->listaAlquileres();

            }

        }

    }

?>