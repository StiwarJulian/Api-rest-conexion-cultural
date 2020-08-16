<?php 

    class mensajesRecipientes{

        private $id;
        private $user_id;
        private $thread_id;
        private $unread;
        private $sender;
        private $deleted;

        public function __construct($id,$user_id,$thread_id,$unread,$sender,$deleted)
        {
            $this->id=$id;
            $this->user_id=$user_id;
            $this->thread_id=$thread_id;
            $this->unread=$unread;
            $this->sender=$sender;
            $this->deleted=$deleted;
        }

        public function setId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setThread_id($thread_id){$this->thread_id=$thread_id;}
        public function getThread_id(){return $this->thread_id;}

        public function setUser_id($user_id){$this->user_id=$user_id;}
        public function getUser_id(){return $this->user_id;}

        public function setUnread($unread){$this->unread=$unread;}
        public function getUnread(){return $this->unread;}

        public function setSender($sender){$this->sender=$sender;}
        public function getSender(){return $this->sender;}

        public function setDeleted($deleted){$this->deleted=$deleted;}
        public function getDeleted(){return $this->deleted;}
    }
?>