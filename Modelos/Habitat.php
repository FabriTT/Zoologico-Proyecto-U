<?php 
    class Habitat{
        
        private $id;
        private $nombre;
        private $clasificacionAmbiente;
        private $nombreAnimal;
        private $capacidad;
        private $horarioLimpieza;
        private $horarioAlimentacion;
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

        public function getClasificacion(){
            return $this->clasificacionAmbiente;
        }

        public function setClasificacion($clasificacionAmbiente){
            $this->clasificacionAmbiente = $clasificacionAmbiente;
        }

        public function getNombreAnimal(){
            return $this->nombreAnimal;
        }

        public function setNombreAnimal($nombreAnimal){
            $this->nombreAnimal = $nombreAnimal;
        }

        public function getCapacidad(){
            return $this->capacidad;
        }

        public function setCapacidad($capacidad){
            $this->capacidad = $capacidad;
        }

        public function getHorarioLimpieza(){
            return $this->horarioLimpieza;
        }

        public function setHorarioLimpieza($horarioLimpieza){
            $this->horarioLimpieza = $horarioLimpieza;
        }

        public function getHorarioAlimentacion(){
            return $this->HorarioAlimentacion;
        }

        public function setHorarioAlimentacion($HorarioAlimentacion){
            $this->HorarioAlimentacion = $HorarioAlimentacion;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }


    }

    

?>
