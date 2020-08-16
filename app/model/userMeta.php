<?php 

    class userMeta{

        private $umeta_id;
        private $user_id;
        private $meta_key;
        private $meta_value;


        public function __Construct($umeta_id,$user_id,$meta_key,$meta_value){
            $this->umeta_id=$umeta_id;
            $this->user_id=$user_id;
            $this->meta_key=$meta_key;
            $this->meta_value=$meta_value;
        }

        public function setUmeta_id($umeta_id){$this->umeta_id=$umeta_id;}
        public function getUmeta_id(){return $this->umeta_id;}

        public function setUser_id($user_id){$this->user_id=$user_id;}
        public function getUser_id(){return $this->user_id;}

        public function setMeta_key($meta_key){$this->meta_key=$meta_key;}
        public function getMeta_key(){return $this->meta_key;}

        public function setMeta_value($meta_value){$this->meta_value=$meta_value;}
        public function getMeta_value(){return $this->meta_value;}
    }

?>