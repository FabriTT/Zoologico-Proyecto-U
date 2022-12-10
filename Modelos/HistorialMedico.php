<?php 
    class HistorialMedico{
        
        private $id;
        private $animal;
        private $empleado;
        private $medicamento;
        private $enfermedad;
        private $situacion;
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

        public function getEnfermedad(){
            return $this->enfermedad;
        }

        public function setEnfermedad($enfermedad){
            $this->enfermedad = $enfermedad;
        }

        public function getSituacion(){
            return $this->situacion;
        }

        public function setSituacion($situacion){
            $this->situacion = $situacion;
        }

        public function getMedicamento(){
            return $this->medicamento;
        }

        public function setMedicamento($medicamento){
            $this->medicamento = $medicamento;
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