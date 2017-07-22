<?php
namespace soxulaXML;
function createXMLDoc($array, $rootNode){
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"
          ."<!DOCTYPE root PUBLIC '-//W3C//DTD HTML 3.2 Final//EN' 'null'>"
          ."<{$rootNode}>";
    
    foreach($array as $value) {$xml .= $value;}
    
    $xml.="</{$rootNode}>";
    return $xml;
}
