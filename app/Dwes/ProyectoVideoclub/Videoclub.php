<?php

namespace Dwes\ProyectoVideoclub;

    require_once '../autoload.php';

    class Videoclub {

        private $nombre;
        private $productos = [];
        private $numProductos;
        private $socios = [];
        private $numSocios;
        private int $numProductosAlquilados = 0;
        private int $numTotalAlquileres = 0;

        public function __construct($nombre)
        {

            $this->nombre = $nombre;
            
        }

        public function getNumProductosAlquilados(): int
        {
            return $this->numProductosAlquilados;
        }

        public function getNumTotalAlquileres(): int
        {
            return $this->numTotalAlquileres;
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

        public function alquilaSocioProducto(int $numeroCliente, array $numeroSoporte)
        {
            try {

                $socioEncontrado = null;
                foreach ($this->socios as $socio) {
                    if ($socio->getNumero() == $numeroCliente) {
                        $socioEncontrado = $socio;
                        break;
                    }
                }

                if (!$socioEncontrado) {
                    throw new \Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException(
                        "Cliente no encontrado."
                    );
                }

                $soporteEncontrado = null;
                foreach ($this->productos as $producto) {
                    if ($producto->getNumero() == $numeroSoporte) {
                        $soporteEncontrado = $producto;
                        break;
                    }
                }

                if (!$soporteEncontrado) {
                    throw new \Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException(
                        "Soporte no encontrado."
                    );
                }

                $socioEncontrado->alquilar($soporteEncontrado);

                $this->numProductosAlquilados++;
                $this->numTotalAlquileres++;

                echo "El cliente {$socioEncontrado->getNombre()} ha alquilado el soporte '{$soporteEncontrado->titulo}'.<br>";

                } catch (\Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException $e) {
                    echo $e->getMessage() . "<br>";

                } catch (\Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException $e) {
                    echo $e->getMessage() . "<br>";

                } catch (\Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException $e) {
                    echo "El soporte ya está alquilado.<br>";

                } catch (\Dwes\ProyectoVideoclub\Util\CupoSuperadoException $e) {
                    echo "El cliente ha alcanzado su cupo máximo de alquileres.<br>";

                } catch (\Exception $e) {
                    echo "Error inesperado: " . $e->getMessage() . "<br>";
                }
        }

        public function alquilarSocioProductos(int $numSocio, array $numerosProductos)
        {
            try {
                $socioEncontrado = null;
                foreach ($this->socios as $socio) {
                    if ($socio->getNumero() === $numSocio) {
                        $socioEncontrado = $socio;
                        break;
                    }
                }

                if (!$socioEncontrado) {
                    throw new \Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException("Cliente no encontrado.");
                }

                $soportesAAlquilar = [];
                foreach ($numerosProductos as $numProducto) {
                    $soporteEncontrado = null;
                    foreach ($this->productos as $producto) {
                        if ($producto->getNumero() === $numProducto) {
                            $soporteEncontrado = $producto;
                            break;
                        }
                    }

                    if (!$soporteEncontrado) {
                        throw new \Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException(
                            "Soporte no encontrado."
                        );
                    }

                    if ($soporteEncontrado->alquilado) {
                        throw new \Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException(
                            "El soporte 6 ya está alquilado."
                        );
                    }

                    $soportesAAlquilar[] = $soporteEncontrado;
                }

                foreach ($soportesAAlquilar as $soporte) {
                    $socioEncontrado->alquilar($soporte);
                    $this->numProductosAlquilados++;
                    $this->numTotalAlquileres++;
                }

                echo "Todos los productos se han alquilado correctamente para '{$socioEncontrado->getNombre()}'.<br>";

            } catch (\Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException $e) {
                echo $e->getMessage() . "<br>";

            } catch (\Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException $e) {
                echo $e->getMessage() . "<br>";

            } catch (\Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException $e) {
                echo $e->getMessage() . " No se ha alquilado ningún producto.<br>";

            } catch (\Dwes\ProyectoVideoclub\Util\CupoSuperadoException $e) {
                echo "El cliente ha alcanzado su cupo máximo de alquileres. No se ha alquilado ningún producto.<br>";

            } catch (\Exception $e) {
                echo "Error inesperado: " . $e->getMessage() . "<br>";
            }

            return $this;
        }

        public function devolverSocioProducto(int $numSocio, int $numProducto)
        {
            try {

                $socioEncontrado = null;
                foreach ($this->socios as $socio) {
                    if ($socio->getNumero() === $numSocio) {
                        $socioEncontrado = $socio;
                        break;
                    }
                }

                if (!$socioEncontrado) {
                    throw new \Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException(
                        "Cliente no encontrado."
                    );
                }

                $soporteEncontrado = null;
                foreach ($this->productos as $producto) {
                    if ($producto->getNumero() === $numProducto) {
                        $soporteEncontrado = $producto;
                        break;
                    }
                }

                if (!$soporteEncontrado) {
                    throw new \Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException(
                        "Soporte no encontrado."
                    );
                }

                $socioEncontrado->devolver($numProducto);

                $soporteEncontrado->alquilado = false;

                $this->numProductosAlquilados--;

                echo "Producto '{$soporteEncontrado->titulo}' devuelto correctamente por '{$socioEncontrado->getNombre()}'.<br>";

            } catch (\Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException $e) {
                echo $e->getMessage() . "<br>";

            } catch (\Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException $e) {
                echo $e->getMessage() . "<br>";

            } catch (\Exception $e) {
                echo "Error inesperado: " . $e->getMessage() . "<br>";
            }

            return $this;
        }

        public function devolverSocioProductos(int $numSocio, array $numerosProductos)
        {
            try {
                $socioEncontrado = null;
                foreach ($this->socios as $socio) {
                    if ($socio->getNumero() === $numSocio) {
                        $socioEncontrado = $socio;
                        break;
                    }
                }

                if (!$socioEncontrado) {
                    throw new \Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException(
                        "Cliente no encontrado."
                    );
                }

                $soportesADevolver = [];
                foreach ($numerosProductos as $numProducto) {
                    $soporteEncontrado = null;
                    foreach ($this->productos as $producto) {
                        if ($producto->getNumero() === $numProducto) {
                            $soporteEncontrado = $producto;
                            break;
                        }
                    }

                    if (!$soporteEncontrado) {
                        throw new \Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException(
                            "Soporte no encontrado."
                        );
                    }

                    $soportesADevolver[] = $soporteEncontrado;
                }

                foreach ($soportesADevolver as $soporte) {
                    $socioEncontrado->devolver($soporte->getNumero());
                    $soporte->alquilado = false;
                    $this->numProductosAlquilados--;
                    echo "Producto '{$soporte->titulo}' devuelto correctamente por '{$socioEncontrado->getNombre()}'.<br>";
                }

            } catch (\Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException $e) {
                echo $e->getMessage() . "<br>";

            } catch (\Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException $e) {
                echo $e->getMessage() . "<br>";

            } catch (\Exception $e) {
                echo "Error inesperado: " . $e->getMessage() . "<br>";
            }

            return $this;
        }


        public function verAlquileresUsuarios() {

            foreach ($this->socios as $socio) {

                $socio->listaAlquileres();

            }

        }

    }

?>