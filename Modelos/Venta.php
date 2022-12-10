<?php 
    class Venta{
        private $id;
        private $planificacion;
        private $entradasMenores;
        private $entradasMayores;
        private $entradasAdultosMayores;
        private $fecha;

        public function __construc(){
            
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getPlanificacion(){
            return $this->planificacion;
        }

        public function setPlanificacion($planificacion){
            $this->planificacion = $planificacion;
        }


        public function getEntradasMenores(){
            return $this->entradasMenores;
        }

        public function setEntradasMenores($entradasMenores){
            $this->entradasMenores = $entradasMenores;
        }

        public function getEntradasMayores(){
            return $this->entradasMayores;
        }

        public function setEntradasMayores($entradasMayores){
            $this->entradasMayores = $entradasMayores;
        }

        public function getEntradasAdultosMayores(){
            return $this->entradasAdultosMayores;
        }

        public function setEntradasAdultosMayores($entradasAdultosMayores){
            $this->entradasAdultosMayores = $entradasAdultosMayores;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }


    }


?>