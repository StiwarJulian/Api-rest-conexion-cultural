<?php 



    class signups{



        private $signup;

        private $domain;

        private $path;

        private $title;

        private $usuario;

        private $email;

        private $fechaRegistro;

        private $fechaActivacion;

        private $active;

        private $activation_key;

        private $meta;



        public function __Construct($signup,$domain,$path,$title,$usuario,$email,

                                    $fechaRegistro,$fechaActivacion,$active,$activation_key,$meta){



            $this->signup=$signup;

            $this->domain=$domain;

            $this->path=$path;

            $this->title=$title;

            $this->usuario=$usuario;

            $this->email=$email;

            $this->fechaRegistro=$fechaRegistro;

            $this->fechaActivacion=$fechaActivacion;

            $this->active=$active;

            $this->activation_key=$activation_key;

            $this->meta=$meta;                            

        }



        public function setSignup($signup){$this->signup=$signup;}

        public function getSignup(){return $this->signup;}



        public function setDomain($domain){$this->domain=$domain;}

        public function getDomain(){return $this->domain;}



        public function setPath($path){$this->path=$path;}

        public function getPath(){return $this->path;}

        

        public function setTitle($title){$this->title=$title;}

        public function getTitle(){return $this->title;}



        public function setUsuario($usuario){$this->usuario=$usuario;}

        public function getUsuario(){return $this->usuario;}



        public function setEmail($email){$this->email=$email;}

        public function getEmail(){return $this->email;}

        

        public function setFechaRegistro($fechaRegistro){$this->fechaRegistro=$fechaRegistro;}

        public function getFechaRegistro(){return $this->fechaRegistro;}



        public function setFechaActivacion($fechaActivacion){$this->fechaActivacion=$fechaActivacion;}

        public function getFechaActivacion(){return $this->fechaActivacion;}



        public function setActive($active){$this->active=$active;}

        public function getActive(){return $this->active;}



        public function setActivation_key($activation_key){$this->activation_key=$activation_key;}

        public function getActivation_key(){return $this->activation_key;}



        public function setMeta($meta){$this->meta=$meta;}

        public function getMeta(){return $this->meta;}

    }



?>