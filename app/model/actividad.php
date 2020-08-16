<?php 

    class actividad{

        private $author;
        private $fecha;
        private $content;
        private $title;
        private $parent;
        private $guid;
        private $post_type;
        private $tipo;
        

        public function __Construct($author,$fecha,$content,$title,$parent,$guid,$post_type,$tipo){
            $this->author=$author;
            $this->fecha=$fecha;
            $this->content=$content;
            $this->title=$title;
            $this->parent=$parent;
            $this->guid=$guid;
            $this->post_type=$post_type;
            $this->tipo=$tipo;
        }


        public function setAuthor($author){$this->author=$author;}
        public function getAuthor(){return $this->author;}

        public function setFecha($fecha){$this->fecha=$fecha;}
        public function getFecha(){return $this->fecha;}

        public function setContent($content){$this->content=$content;}
        public function getContent(){return $this->content;}

        public function setTitle($title){$this->title=$title;}
        public function getTitle(){return $this->title;}

        public function setParent($parent){$this->parent=$parent;}
        public function getParent(){return $this->parent;}

        public function setGuid($guid){$this->guid=$guid;}
        public function getGuid(){return $this->guid;}

        public function setPost_type($post_type){$this->post_type=$post_type;}
        public function getPost_type(){return $this->post_type;}

        public function setTipo($tipo){$this->tipo=$tipo;}
        public function getTipo(){return $this->tipo;}
    }


?>