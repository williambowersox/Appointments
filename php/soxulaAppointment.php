<?php
namespace schedule{ 
    define("USDATETIME" , "m/d/Y h:i A");
    define("DATADATETIME", "Y/m/d h:i A");
    
    class Appointments{
        public static $count = 0;
        public function __construct($ListOwner){$this->owner = $ListOwner; Appointments::$count++;}
        public function __destruct(){Appointments::$count--;}
        public function AddAppointment($Appointment){$this->AppointmentArray[$this->AppointmentCount()] = $Appointment;}
        public function RemoveAppointment($index){  
            if($this->AppointmentArray[$index]){
                unset($this->AppointmentArray[$index]);
                $this->AppointmentArray = array_values($this->AppointmentArray);
                return true;
            }
            return false;
        }
        public function GetAppointment($index){
            return $this->AppointmentArray[$index];
        }
        public function AppointmentCount(){return count($this->AppointmentArray);}
        private $owner;
        private $AppointmentArray = array();
    }
    
    class  Appointment{
        public static $count = 0;
        public function __construct($date,$myself, $withWhom,$PhoneNumber, $Topic="",$description="", $Address="", $public=false){
            $this->date = $date;
            $this->myself = $myself;
            $this->withWhom = $withWhom;
            $this->topic = $Topic;
            $this->description = $description;
            $this->address = $Address;
            $this->phoneNumber = $PhoneNumber;
            $this->public = $public;
            Appointment::$count++;
        }
        public function __destruct(){
            Appointment::$count--;
        }
        public function togglePublic(){
            if($this->public)
            {$this->public = false;}
            else
            {$this->public = true;}
        }
        public function getDate($format){return $this->date->format($format);}
        public function getConferee(){return $this->withWhom;}
        public function getTopic(){return $this->topic;}
        public function getDescription(){return $this->description;}
        public function isPublic(){return $this->public;}
        public function getPhone(){return $this->phoneNumber;}
        public function toJSON(){
            $json = "{\"Appointment\":{";
            $json.= "\"Date\":\"";
            $json.= $this->date->format(DATADATETIME)."\",";
            $json.= "\"Myself\":\"{$this->myself}\",";
            $json.= "\"Invitee\":\"{$this->withWhom}\",";
            $json.= "\"Topic\":\"{$this->topic}\",";
            $json.= "\"Description\":\"{$this->description}\",";
            $json.= "\"Phone Number\":\"{$this->phoneNumber}\"";
            if($this->public)
                {$json.= ",\"Public\":\"{$this->public}\"";}
            $json.= "}";
            $json.= "}";
            return $json;
        }
        public function toXMLEntry(){
            $xml = "<appointment date=\"{$this->date->format(DATADATETIME)}\" caller=\"{$this->myself}\" invitee=\"{$this->withWhom}\" phoneNumber=\"{$this->phoneNumber}\">"
                        .   "<topic>{$this->topic}"
                                . "<description>"
                                      . "{$this->description}"
                                . "</description>"
                        .   "</topic>"
                        ."</appointment>";
            return $xml;
        }
        public function toXMLDoc(){
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"
                  ."<!DOCTYPE root PUBLIC '-//W3C//DTD HTML 3.2 Final//EN' 'null'>"
                    ."<appointments>"
                  .$this->toXMLEntry()
                  ."</appointments>";

            return $xml;
        }
        private $date;
        private $myself;
        private $withWhom;
        private $topic;
        private $description;
        private $address;
        private $public;  
        private $phoneNumber;
    }
    
}