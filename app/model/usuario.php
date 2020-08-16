<?php 
    
    class usuario{
        private $id_user;
        private $user;
        private $clave;
        private $nicename;
        private $email;
        private $url;
        private $fecha;
        private $llave;
        private $status;
        private $display;
        public function __construct($id_user,$user,$clave,$nicename,$email,$url,$fecha,
                                    $llave,$status,$display){           
            $this->id_user=$id_user;
            $this->user=$user;
            $this->clave=$clave;
            $this->nicename=$nicename;
            $this->email=$email;
            $this->url=$url;
            $this->fecha=$fecha;
            $this->llave=$llave;
            $this->status=$status;
            $this->display=$display;
        }
        public function setId_user($id_user){$this->id_user=$id_user;}
        public function getId_user(){return $this->id_user;}
        public function setUser($user){$this->user=$user;}
        public function getUser(){return $this->user;}
        public function setClave($clave){$this->clave=$clave;}
        public function getClave(){return $this->clave;}
        public function setNicename($nicename){$this->nicename=$nicename;}
        public function getNicename(){return $this->nicename;}
        public function setEmail($email){$this->email=$email;}
        public function getEmail(){return $this->email;}
        public function setUrl($url){$this->url=$url;}
        public function getUrl(){return $this->url;}
        public function setFecha($fecha){$this->fecha=$fecha;}
        public function getFecha(){return $this->fecha;}
        public function setLLave($llave){$this->llave=$llave;}
        public function getLLave(){return $this->llave;}
        public function setStatus($status){$this->status=$status;}
        public function getStatus(){return $this->status;}
        public function setDisplay($display){$this->display=$display;}
        public function getDisplay(){return $this->display;}
    }
?>