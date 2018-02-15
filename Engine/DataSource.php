<?php
namespace Engine;

abstract class DataSource{
    abstract protected function CheckRequest($request);
    abstract protected function ObtainData($request);

    public function GetData($data){
        return $data;
    }

    public function Match($data, $match){
        $out = array();
        foreach ($data as $key => $value){
            $newArray = array();
            foreach ($match as $matchKey => $matchValue){
                $newArray[$matchValue] = $value[$matchKey];
            }
            $out[] = $newArray;
        }
        return $out;
    }

    public function GetFirst($data){
        if (is_array($data) && array_key_exists(0, $data)){
            return $data[0];
        }else{
            return null;
        }
    }

    public function Run($request){
        if (!$this->CheckRequest($request)){
            throw(new \Exceptions\InternalException("Bad inner request on check in ".get_class($this)));
        }

        return $this->GetData($this->ObtainData($request));
    }
}