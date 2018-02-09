<?php
namespace Engine;

class Request {
    public function make($data){
        if ($data){
            foreach ($data as $key => $value){
                $funcArg = 'set'.ucfirst($key);

                if (method_exists($this, $funcArg)){
                    $this->$funcArg($value);
                }else{
                    throw(new \Exceptions\InternalException("no such parameter \"" . $key . "\" for this request"));
                }
            }
        }
    }
}