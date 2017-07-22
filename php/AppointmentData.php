<?php
namespace schedule{
    require_once 'soxulaXML.php';
    use \DateTime;
    use \soxulaXML;
    
    require_once 'Appointment.php';
    $appArray[0] =  new Appointment(new DateTime("2017-07-27 02:30:00 PM"),"William Bowersox", "JJR Solutions","614.835.7534","Interview",".NET Developer");
    $appArray[1] =  new Appointment(new DateTime("2017-07-27 02:30:00 PM"),"BoB Wilson", "JJR Solutions","614.835.7534","Interview",".NET Developer");
    $appArray[2] =  new Appointment(new DateTime("2017-07-27 02:30:00 PM"),"Clum Hardy", "JJR Solutions","614.835.7534","Interview",".NET Developer");
    /*$appArray[0]->togglePublic();*/
    
   $Appointments = new Appointments("Me");
   $Appointments->addAppointment(new Appointment(new DateTime("2017-07-27 02:30:00 PM"),"William Bowersox", "JJR Solutions","614.835.7534","Interview",".NET Developer"));
   $Appointments->addAppointment(new Appointment(new DateTime("2017-07-27 02:30:00 PM"),"BoB Wilson", "JJR Solutions","614.835.7534","Interview",".NET Developer"));
   $Appointments->addAppointment(new Appointment(new DateTime("2017-07-27 02:30:00 PM"),"Clum Hardy", "JJR Solutions","614.835.7534","Interview",".NET Developer"));
   
 
   $JavaScript = "var Appointments = [];".PHP_EOL;
   for($i=0; $i < $Appointments->AppointmentCount(); $i++){
        $JavaScript.= "Appointments[{$i}] = {$Appointments->getAppointment($i)->toJSON()};".PHP_EOL;
   }
   echo $JavaScript;
   
}