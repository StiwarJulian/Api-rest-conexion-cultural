<?php 

    class comentarios{

        private $id;
        private $post_id;
        private $autor;
        private $email;
        private $fecha;
        private $contenido;
        private $parent;
        private $user_id;

        public function __construct($id,$post_id,$autor,$email,$fecha,$contenido,$parent,$user_id)
        {
            $this->id=$id;
            $this->post_id=$post_id;
            $this->autor=$autor;
            $this->email=$email;
            $this->fecha=$fecha;
            $this->contenido=$contenido;
            $this->parent=$parent;
            $this->user_id=$user_id;
        }

        public function setId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setPost_id($post_id){$this->post_id=$post_id;}
        public function getPost_id(){return $this->post_id;}

        public function setAutor($autor){$this->autor=$autor;}
        public function getAutor(){return $this->autor;}

        public function setEmail($email){$this->email=$email;}
        public function getEmail(){return $this->email;}

        public function setFecha($fecha){$this->fecha=$fecha;}
        public function getFecha(){return $this->fecha;}

        public function setContenido($contenido){$this->contenido=$contenido;}
        public function getContenido(){return $this->contenido;}

        public function setParent($parent){$this->parent=$parent;}
        public function getParent(){return $this->parent;}

        public function setUser_id($user_id){$this->user_id=$user_id;}
        public function getUser_id(){return $this->user_id;}
    }

?>