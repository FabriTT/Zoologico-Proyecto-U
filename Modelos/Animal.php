<?php 
    class Animal{
        
        private $id;
        private $nombre;
        private $nombreC;
        private $especie;
        private $apodo;
        private $habitat;
        private $clasificacionVertebral;
        private $tipoAlimentacion;
        private $fechaNacimiento;
        private $imagen;
        private $estado;


        public function __construct(){

        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function getNombreC(){
            return $this->nombreC;
        }

        public function setNombreC($nombreC){
            $this->nombreC = $nombreC;
        }

        public function getEspecie(){
            return $this->especie;
        }

        public function setEspecie($especie){
            $this->especie = $especie;
        }

        public function getApodo(){
            return $this->apodo;
        }

        public function setApodo($apodo){
            $this->apodo = $apodo;
        }

        public function getHabitat(){
            return $this->habitat;
        }

        public function setHabitat($habitat){
            $this->habitat = $habitat;
        }

        public function getClasificacion(){
            return $this->clasificacionVertebral;
        }

        public function setClasificacion($clasificacionVertebral){
            $this->clasificacionVertebral = $clasificacionVertebral;
        }

        public function getTipoAlimentacion(){
            return $this->tipoAlimentacion;
        }

        public function setTipoAlimentacion($tipoAlimentacion){
            $this->tipoAlimentacion = $tipoAlimentacion;
        }


        public function getFechaNacimiento(){
            return $this->fechaNacimiento;
        }

        public function setFechaNacimiento($fechaNacimiento){
            $this->fechaNacimiento = $fechaNacimiento;
        }

        public function getImagen(){
            return $this->imagen;
        }

        public function setImagen($imagen){
            $this->imagen = $imagen;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }


    }

    

?>
