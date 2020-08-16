<?php 

    class media{

        private $media_id;
        private $autor;
        private $titulo;
        private $album_id;
        private $tipo;
        private $context;
        private $context_id;
        private $fecha;
        private $size;
        
        public function __Construct($media_id,$autor,$titulo,$album_id,$tipo,$context,
        $context_id,$fecha,$size){

        $this->media_id=$media_id;
        $this->autor=$autor;
        $this->titulo=$titulo;
        $this->album_id=$album_id;
        $this->tipo=$tipo;
        $this->context=$context;
        $this->context_id=$context_id;
        $this->fecha=$fecha;
        $this->size=$size;
        }

        public function setMedia_id($media_id){$this->media_id = $media_id;}
        public function getMedia_id(){return $this->media_id;}

        public function setAutor($autor){$this->autor = $autor;}
        public function getAutor(){return $this->autor;}

        public function setTitulo($titulo){$this->titulo = $titulo;}
        public function getTitulo(){return $this->titulo;}

        public function setAlbum_id($album_id){$this->album_id = $album_id;}
        public function getAlbum_id(){return $this->album_id;}

        public function setTipo($tipo){$this->tipo = $tipo;}
        public function getTipo(){return $this->tipo;}

        public function setContext($context){$this->context = $context;}
        public function getContext(){return $this->context;}

        public function setContext_id($context_id){$this->context_id = $context_id;}
        public function getContext_id(){return $this->context_id;}

        public function setFecha($fecha){$this->fecha=$fecha;}
        public function getFecha(){return $this->fecha;}

        public function setSize($size){$this->size = $size;}
        public function getSize(){return $this->size;}
    }
?>