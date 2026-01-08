<?php
//Ejercicio1
class vehiculo{
    public function __construct(
        public string $marca,
        public string $modelo,
        public int $anio
){}

    public function info(){
        echo "Marca: ".$this->marca;
        echo "Modelo: ".$this->modelo;
        echo "Anio: ".$this->anio;

    }
}
//Ejercicio2
class coche extends vehiculo{
    public $numeroPuertas;
    public function __construct(string $marca, string $modelo, int $anio, $numeroPuertas){
        parent::__construct($marca, $modelo, $anio);
        $this->numeroPuertas = $numeroPuertas;
    }
    public function info(){
        echo "Marca: ".$this->marca;
    }
}

