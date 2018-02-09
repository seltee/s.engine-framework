<?php
namespace Engine;

abstract class DataSource{
    abstract protected function CheckRequest($request);
    abstract protected function ObtainData($request);

    public function GetData($data){
        return $data;
    }

    public function Run($request){
        if (!$this->CheckRequest($request)){
            throw(new \Exceptions\InternalException("Bad inner request on check in ".get_class($this)));
        }

        return $this->GetData($this->ObtainData($request));
    }
}