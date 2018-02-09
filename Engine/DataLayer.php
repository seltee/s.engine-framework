<?php
namespace Engine;

abstract class DataLayer{
    abstract protected function getSecurityLayer();
    abstract public function processException(\Exception $e);

    protected function addFunction($name, $package, $request = null, $funcName = null, $securityLevel = 0){
        if (!property_exists($this, 'functions')){
            $this->functions = array();
        }

        if (array_key_exists ( $name , $this->functions )){
            $this->processException(new \Exceptions\InternalException("Функция ".$name." уже существует, невозможно добавить в конструкторе"));
        }

        $request = str_replace('/', '\\', $request);

        $this->functions[$name] = array(
            "funcName" => $funcName ? $funcName : $name,
            "request" => $request ? $request : null,
            "package" => 'DataLayer\\'.$package,
            "secured" => $securityLevel
        );

        return true;
    }

    protected function addSecuredFunction($name, $package, $request = null, $funcName = null, $securityLevel = 1){
        return $this->addFunction($name, $package, $request, $funcName, $securityLevel);
    }

    //Сначала парсит массив в реквест, затем вызывает процессРеквест
    public function processFunction($functionName, $infoArray){
        if (!$this->functions || !array_key_exists($functionName, $this->functions)){
            $this->processException(new \Exceptions\InternalException("Функция ".$functionName." не существует"));
        }

        $requestName = $this->functions[$functionName]['request'];
        $request = new $requestName;
        $request->make($infoArray);

        return $this->processRequest($functionName, $request);
    }

    //Вызывает функцию из нужного даталеера, передавая ей реквест. Возвращает ответ функции
    public function processRequest($functionName, $request, $securityCheck = true){
        if (!$this->functions || !array_key_exists($functionName, $this->functions)){
            $this->processException(new \Exceptions\InternalException("No such function ".$functionName));
        }

        $securityLayer = $this->getSecurityLayer();
        $check = $securityLayer->check($this->functions[$functionName], $request, $this, $securityCheck);

        if ($check != true){
            $this->processException(new \Exceptions\InternalException("Security layer not passed"));
        }

        $packageName = $this->functions[$functionName]['package'].'\\Package';
        $package = new $packageName;

        if (!method_exists($package, $functionName)){
            $this->processException(new \Exceptions\InternalException("No such function ".$functionName));
        }

        $ret = $package->$functionName();
        if (is_object($ret)) {
            try {
                $ret = $ret->Run($request);
            }catch (\Exception $e){
                $this->processException($e);
            }
        }

        $retArray = array(
            'success' => true,
            'data' => $ret
        );

        return $retArray;
    }
}