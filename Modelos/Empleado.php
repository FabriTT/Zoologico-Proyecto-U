<?php 
    class Empleado{
        
        private $id;
        private $nombre;
        private $apellidoP;
        private $apellidoM;
        private $fechaN;
        private $carnet;
        private $cargo;
        private $usuario;
        private $contraseña;
        private $telefono;
        private $telefonoR;
        private $correo;
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

        public function getApellidoP(){
            return $this->apellidoP;
        }

        public function setApellidoP($apellidoP){
            $this->apellidoP = $apellidoP;
        }
        
        public function getApellidoM(){
            return $this->apellidoM;
        }

        public function setApellidoM($apellidoM){
            $this->apellidoM = $apellidoM;
        }

        public function getFechaN(){
            return $this->fechaN;
        }

        public function setFechaN($fechaN){
            $this->fechaN = $fechaN;
        }

        public function getCarnet(){
            return $this->carnet;
        }

        public function setCarnet($carnet){
            $this->carnet = $carnet;
        }

        public function getCargo(){
            return $this->cargo;
        }

        public function setCargo($cargo){
            $this->cargo = $cargo;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }

        public function getContraseña(){
            return $this->contraseña;
        }

        public function setContraseña($contraseña){
            $this->contraseña = $contraseña;
        }

        public function getTelefono(){
            return $this->telefono;
        }

        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }

        public function getTelefonoR(){
            return $this->telefonoR;
        }

        public function setTelefonoR($telefonoR){
            $this->telefonoR = $telefonoR;
        }

        public function getCorreo(){
            return $this->correo;
        }

        public function setCorreo($correo){
            $this->correo = $correo;
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
