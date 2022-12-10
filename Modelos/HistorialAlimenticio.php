<?php 
    class HistorialAlimenticio{
        
        private $id;
        private $animal;
        private $empleado;
        private $alimento;
        private $cantidad;
        private $fecha;
        private $estado;


        public function __construct(){

        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getAnimal(){
            return $this->animal;
        }

        public function setAnimal($animal){
            $this->animal = $animal;
        }

        public function getEmpleado(){
            return $this->empleado;
        }

        public function setEmpleado($empleado){
            $this->empleado = $empleado;
        }

        public function getAlimento(){
            return $this->alimento;
        }

        public function setAlimento($alimento){
            $this->alimento = $alimento;
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