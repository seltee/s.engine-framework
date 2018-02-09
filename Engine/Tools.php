<?php
namespace Engine;

class Tools
{
    static public function makeGoodPrice($price){
        if ($price && strlen($price > 0)) {
            return number_format(is_string($price) ? floatval($price) : $price, 0, ",", " ");
        }else{
            return $price;
        }
    }

    static public function jsonSuperEncode($object){
        if (is_object($object)){
            $newObject = clone $object;
        }else{
            $newObject = $object;
        }

        foreach($newObject as $key => $value){
            if (is_string($value)){
                if (is_object($newObject)){
                    $newObject->$newObject = str_replace ( "\n", "\\n" , $newObject->$newObject);
                    $newObject->$newObject = str_replace ( "\r", "" , $newObject->$newObject);
                }else{
                    $newObject[$key] = str_replace ( "\n", "\\n" , $newObject[$key]);
                    $newObject[$key] = str_replace ( "\r", "" , $newObject[$key]);
                }
            }
        }

        $out = json_encode($newObject);
        unset($newObject);
        return $out;
    }
}