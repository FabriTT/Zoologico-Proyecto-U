<?php 
    class Alimento{
        
        private $id;
        private $nombre;
        private $empaque;
        private $clasificacionAnimal;
        private $stock;
        private $consumoMensual;
        private $costoPedido;
        private $costoMantenimiento;
        private $entregaDias;
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

        public function getClasificacion(){
            return $this->clasificacion;
        }

        public function setClasificacion($clasificacion){
            $this->clasificacion = $clasificacion;
        }

        public function getStock(){
            return $this->stock;
        }

        public function setStock($stock){
            $this->stock = $stock;
        }

        public function getConsumoMensual(){
            return $this->consumoMensual;
        }

        public function setConsumoMensual($consumoMensual){
            $this->consumoMensual = $consumoMensual;
        }

        public function getCostoPedido(){
            return $this->costoPedido;
        }

        public function setCostoPedido($costoPedido){
            $this->costoPedido = $costoPedido;
        }

        public function getCostoMantenimiento(){
            return $this->costoMantenimiento;
        }

        public function setCostoMantenimiento($costoMantenimiento){
            $this->costoMantenimiento = $costoMantenimiento;
        }

        public function getEntregaDias(){
            return $this->entregaDias;
        }

        public function setEntregaDias($entregaDias){
            $this->entregaDias = $entregaDias;
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
