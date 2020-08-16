<?php 

    class profileData{

        private $id;
        private $field_id;
        private $user_id;
        private $value;
        private $updated; 

        public function __Construct($id,$field_id,$user_id,$value,$updated){
            $this->id=$id;
            $this->field_id=$field_id;
            $this->user_id=$user_id;
            $this->value=$value;
            $this->updated=$updated;
        }

        public function segId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setField_id($field_id){$this->field_id=$field_id;}
        public function getField_id(){return $this->field_id;}

        public function setUser_id($user_id){$this->user_id=$user_id;}
        public function getUser_id(){return $this->user_id;}

        public function setValue($value){$this->value=$value;}
        public function getValue(){return $this->value;}

        public function setUpdated($updated){$this->updated=$updated;}
        public function getUpdated(){return $this->updated;}
    }

?>