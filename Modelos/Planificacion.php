<?php 
    class Planificacion{
        private $id;
        private $empleado;
        private $precioEMenores;
        private $precioEMayores;
        private $precioEAdultosMayores;
        private $cantidad;
        private $fecha;
        private $estado;

        public function __construc(){

        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getEmpleado(){
            return $this->empleado;
        }

        public function setEmpleado($empleado){
            $this->empleado = $empleado;
        }


        public function getPrecioEMenores(){
            return $this->precioEMenores;
        }

        public function setPrecioEMenores($precioEMenores){
            $this->precioEMenores = $precioEMenores;
        }

        public function getPrecioEMayores(){
            return $this->precioEMayores;
        }

        public function setPrecioEMayores($precioEMayores){
            $this->precioEMayores = $precioEMayores;
        }

        public function getPrecioEAdultosMayores(){
            return $this->precioEAdultosMayores;
        }

        public function setPrecioEAdultosMayores($precioEAdultosMayores){
            $this->precioEAdultosMayores = $precioEAdultosMayores;
        }

        
        public function getCantidad(){
            return $this->cantidad;
        }

        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }


    }


?>