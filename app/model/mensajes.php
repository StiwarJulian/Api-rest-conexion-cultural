<?php 

   class mensajes{

        private $id;
        private $thread_id;
        private $sender_id;
        private $subject;
        private $message;
        private $date_sent;

        public function __Construct($id,$thread_id,$sender_id,$subject,$message,$date_sent){
            $this->id=$id;
            $this->thread_id=$thread_id;
            $this->sender_id=$sender_id;
            $this->subject=$subject;
            $this->message=$message;
            $this->date_sent=$date_sent;
        }

        public function setId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setThread_id($thread_id){$this->thread_id=$thread_id;}
        public function getThread_id(){return $this->thread_id;}

        public function setSender_id($sender_id){$this->sender_id=$sender_id;}
        public function getSender_id(){return $this->sender_id;}

        public function setSubject($subject){$this->subject=$subject;}
        public function getSubject(){return $this->subject;}

        public function setMessage($message){$this->message=$message;}
        public function getMessage(){return $this->message;}

        public function setDate_sent($date_sent){$this->date_sent=$date_sent;}
        public function getDate_sent(){return $this->date_sent;}
   } 

?>