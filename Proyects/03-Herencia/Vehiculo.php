<?php
class Vehiculo {

    private $color;
    private $peso;

    public function __construct($color,$peso) {
        $this->color = $color;
        $this->peso = $peso;
    }

    public function getColor() {
        return $this->color;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function repintar($color) {
        $this->color = $color;
    }

    public function circula() {
        echo "El vehículo circula";
    }

    public function añadir_persona($peso_persona) {
        $this->peso += $peso_persona;
    }

}

class Dos_ruedas extends Vehiculo {

    private $cilindrada;

    public function __construct($color, $peso, $cilindrada) {
        parent::__construct($color, $peso);
        $this->cilindrada = $cilindrada;
    }

    public function ponerGasolina ($litros) {
        
    }
}

class Cuatro_ruedas extends Vehiculo {

    private $numero_puertas;

    public function __construct($color, $peso, $numero_puertas) {
        parent::__construct($color, $peso);
        $this->numero_puertas = $numero_puertas;
    }

    public function repintar ($color) {
        parent::repintar($color);
    }
}

class Coche extends Cuatro_ruedas {

    private $numero_cadenas_nieve;

    public function __construct($color,$peso,$numero_puertas) {
        parent::__construct($color,$peso,$numero_puertas);
        $this->numero_cadenas_nieve = 0;
    }

    public function añadir_cadenas_nieve($num) {
        $this->numero_cadenas_nieve += $num;
    }

    public function quitar_cadenas_nieve($num) {
        $this->numero_cadenas_nieve -= $num;
    }

    public function getCad() {
        return $this->numero_cadenas_nieve;
    }
}

class Camion extends Cuatro_ruedas {

    private $longitud;

    public function __construct($color,$peso,$numero_puertas,$longitud) {
        parent::__construct($color,$peso,$numero_puertas);
        $this->longitud = $longitud;
    }

    public function añadir_remolque($longitud_remolque) {
        $this->longitud += $longitud_remolque;
    }
}