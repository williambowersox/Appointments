<?php
/* 
 * Copyright 2017 William Bowersox.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace schedule;
require_once 'soxulaAppointment.php';
require_once 'soxulaDatabase.php';
use \DateTime;

$db = new SoxulaDatabase();
$publicArray = $db->SelectQuery('appointments',['date','owner','invitee','phone number','topic','description','address'],['public','owner'],[1,1],'id',true);
$fieldWidth = 7;
$Appointments = new Appointments("TEST");

for($i=0,$record=0; $i<count($publicArray); $i+=$fieldWidth, $record++){
    $Appointments->addAppointment(new Appointment(new DateTime($publicArray[0+$i]),$publicArray[1+$i], $publicArray[2+$i],$publicArray[3+$i],$publicArray[4+$i],$publicArray[5+$i],$publicArray[6+$i],true));    
}

$JavaScript = "var Appointments = [];".PHP_EOL;
for($i=0; $i < $Appointments->AppointmentCount(); $i++){
    $JavaScript.= "Appointments[{$i}] = {$Appointments->getAppointment($i)->toJSON()};".PHP_EOL;
}
echo $JavaScript;
