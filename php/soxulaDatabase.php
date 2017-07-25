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
  use \mysqli; 
/**
 * Sqli wrapper class for simple website database functions
 *
 * @author William Bowersox
 */
class SoxulaDatabase {
    public function __construct(){
        $this->connection  = new mysqli($this->dbServer,$this->dbUserName,$this->dbPassword,$this->dbName);
    }
    
    private function createTypeString($array){
        $str = "";
        foreach($array as $item){
            $str.= $this->getTypeStringField($item);
        }
        return $str;
    }
    private function addToParamArray(&$array,$value){
        $arrayCount = count($array);
        $array[$arrayCount] = $value;
    }
    private function ConvertResultToArray($result){
       $i =0;
       $rowArray = array();
       while($row = $result->fetch_assoc()){
           $rowArray[$i] = $row;
           $i++;
       }
       $result->close();
       return $rowArray;
    }
    private function getTypeStringField($var){
        $type = gettype($var);
        switch($type){
            case 'boolean':
                return 'b';
            case 'integer':
                return 'i';
            case 'double':
                return 'd';
            case 'string':
                return 's';
            default:
                return "Invalid Type.";
        }
    }
    public function SelectQuery($from,$selectFieldArray=array(),$whereArrayFields=array(),$whereArrayValues=array(),$orderBy = null,$desc = false){
        if(!$from) {die("You must suppy a table");}
        if(!$selectFieldArray){ die("You must supply select fields.");}
        $params = array();
        
        $str = "SELECT ";
        foreach($selectFieldArray as $field){
            $str.= "`{$field}`,";
        }$str = substr($str,0,strlen($str)-1);
        $str.= " FROM {$from}";
        
        $whereFieldsCount = count($whereArrayFields);
        $whereValuesCount = count($whereArrayValues);
        
        if($whereArrayFields && 
                $whereArrayValues && 
                $whereFieldsCount == $whereValuesCount
        ){
            $str.= " WHERE";
            for($i=0;$i<$whereFieldsCount;$i++){
                $this->addToParamArray($params,$whereArrayValues[$i]);
                $str.= " {$whereArrayFields[$i]} = (?) AND";
            }$str = substr($str,0,strlen($str)-3);
        }
        if($orderBy){
            $str.= " ORDER BY {$orderBy} ";
            $str = substr($str,0,strlen($str)-1);
            if($desc){$str.= " DESC";}
        }
        $str.= ";";

        $statementObj = $this->connection->prepare($str);
        print_r($statementObj);
        if(!$statementObj){print "Connection failed";} 
        
        $typeString = $this->createTypeString($params);
        
        $whereCount = count($whereArrayValues);

        switch($whereCount){
            case 1:{
                $statementObj->bind_param($typeString,$whereArrayValues[0] );
                break;
            }
            case 2:{
                $statementObj->bind_param($typeString,$whereArrayValues[0],$whereArrayValues[1] );
                break;
            }
            case 3:{
                $statementObj->bind_param($typeString,$whereArrayValues[0],$whereArrayValues[1],$whereArrayValues[2] );
                break;
            }
            case 4:{
                $statementObj->bind_param($typeString,$whereArrayValues[0],$whereArrayValues[1],$whereArrayValues[2],$whereArrayValues[3] );
                break;
            }
            case 5:{
                $statementObj->bind_param($typeString,$whereArrayValues[0],$whereArrayValues[1],$whereArrayValues[2],$whereArrayValues[3],$whereArrayValues[4] );
                break;
            }
            case 6:{
                $statementObj->bind_param($typeString,$whereArrayValues[0],$whereArrayValues[1],$whereArrayValues[2],$whereArrayValues[3],$whereArrayValues[4],$whereArrayValues[5], $orderBy);
                break;
            }
            case 7:{
                $statementObj->bind_param($typeString,$whereArrayValues[0],$whereArrayValues[1],$whereArrayValues[2],$whereArrayValues[3],$whereArrayValues[4],$whereArrayValues[5],$whereArrayValues[6] );
                break;
            }
            case 8:{
                $statementObj->bind_param($typeString,$whereArrayValues[0],$whereArrayValues[1],$whereArrayValues[2],$whereArrayValues[3],$whereArrayValues[4],$whereArrayValues[5],$whereArrayValues[6], $whereArrayValues[7] );
                break;
            }
            case 9:{
                $statementObj->bind_param($typeString,$whereArrayValues[0],$whereArrayValues[1],$whereArrayValues[2],$whereArrayValues[3],$whereArrayValues[4],$whereArrayValues[5],$whereArrayValues[6], $whereArrayValues[7], $whereArrayValues[8].$orderBy);
                break;
            }
            case 10:{
                $statementObj->bind_param($typeString,$whereArrayValues[0],$whereArrayValues[1],$whereArrayValues[2],$whereArrayValues[3],$whereArrayValues[4],$whereArrayValues[5],$whereArrayValues[6], $whereArrayValues[7], $whereArrayValues[8],$whereArrayValues[9] );
                break;
            }
            default:
                die("TOO MANY WHERE PARAMETERS");
                break;
        }
        $statementObj->execute();
        
        $selectCount = count($selectFieldArray);
        switch($selectCount){
            case 1:{
                $statementObj->bind_result($param1);
                break;
            }
            case 2:{
                $statementObj->bind_result($param1,$param2);
                break;
            }
            case 3:{
                $statementObj->bind_result($param1,$param2,$param3);
                break;
            }
            case 4:{
                $statementObj->bind_result($param1,$param2,$param3,$param4);
                break;
            }
            case 5:{
                $statementObj->bind_result($param1,$param2,$param3,$param4,$param5);
                break;
            }
            case 6:{
                $statementObj->bind_result($param1,$param2,$param3,$param4,$param5,$param6);
                break;
            }
            case 7:{
                $statementObj->bind_result($param1,$param2,$param3,$param4,$param5,$param6,$param7);
                break;
            }
            case 8:{
                $statementObj->bind_result($param1,$param2,$param3,$param4,$param5,$param6,$param7, $param8);
                break;
            }
            case 9:{
                $statementObj->bind_result($param1,$param2,$param3,$param4,$param5,$param6,$param7, $param8, $param9);
                break;
            }
            case 10:{
                $statementObj->bind_result($param1,$param2,$param3,$param4,$param5,$param6,$param7, $param8, $param9,$param10);
                break;
            }
            default:
                die("TOO MANY WHERE PARAMETERS");
                break;
        }
        
        $paramArray = array();
        while($statementObj->fetch()){
            switch($selectCount){
                case 10:
                    $paramArray[] = $param10;
                case 9:
                    $paramArray[] = $param9;
                case 8:
                    $paramArray[] = $param8;
                case 7:
                    $paramArray[] = $param7;
                case 6:
                    $paramArray[] = $param6;
                case 5:
                    $paramArray[] = $param5;
                case 4:
                    $paramArray[] = $param4;
                case 3:
                    $paramArray[] = $param3;
                case 2:
                    $paramArray[] = $param2;
                case 1:
                    $paramArray[] = $param1;
                    break;
                default:
                    die("YOU NEED TO PROVIDE SELECT FIELDS");

            }
        }
        $paramArray = array_reverse($paramArray);
        return $paramArray;
        
        $this->connection->close();
    }
    public function SimpleSelectQuery($sql){
        $rowArray = $this->ConvertResultToArray($this->connection->query($sql));
        $this->connection->close();
        return $rowArray;
    }
    
    
    private $connection;
    private $dbPassword = "";
    private $dbUserName = "root";
    private $dbServer = "localhost";
    private $dbName = "legio10_soxula";
}

/*$test = new SoxulaDatabase();
$result = $test->SelectQuery('appointments',['topic','description','phone number'],['id'],[1],'id',true);
print_r($result);

print $result[0];
*/