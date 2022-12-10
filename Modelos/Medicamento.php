<?php 
    class Medicamento{
        
        private $id;
        private $nombre;
        private $empaque;
        private $tipoAdministracion;
        private $stock;
        private $fechaVencimiento;
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

        public function getEmpaque(){
            return $this->empaque;
        }

        public function setEmpaque($empaque){
            $this->empaque = $empaque;
        }

        public function getTipoAdministracion(){
            return $this->tipoAdministracion;
        }

        public function setTipoAdministracion($tipoAdministracion){
            $this->tipoAdministracion = $tipoAdministracion;
        }


        public function getStock(){
            return $this->stock;
        }

        public function setStock($stock){
            $this->stock = $stock;
        }

        public function getFechaVencimiento(){
            return $this->fechaVencimiento;
        }

        public function setFechaVencimiento($fechaVencimiento){
            $this->fechaVencimiento = $fechaVencimiento;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }


    }

    

?>
