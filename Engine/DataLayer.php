<?php
namespace Engine;

use Engine\Creational\Singleton;

abstract class DataLayer extends Singleton {
    abstract protected function getSecurityLayer();
    abstract protected function doLoads();

    public function loadPackage($packageName){
        $packagePath = '\\DataLayer\\'.$packageName.'\\Package';
        $package = new $packagePath;

        if (!property_exists($this, 'packages')){
            $this->packages = array();
        }

        if (array_key_exists($packageName, $this->packages)){
            throw new \Exceptions\InternalException("Package ".$packageName." already exist");
        }

        $this->packages[$packageName] = $package;

        $functions = $package->getFunctions();
        if ($functions) {
            foreach ($functions as $key => $value) {
                $this->addFunction($value['Name'], $package, $packageName, $value['Request'], $value['Name'], $value['Description'], $value['SecurityLevel']);
            }
        }
    }

    protected function addFunction($name, $package, $packageName, $request = null, $funcName = null, $description = "", $securityLevel = 0){
        if (!property_exists($this, 'functions')){
            $this->functions = array();
        }

        if (array_key_exists ( $name , $this->functions )){
            $this->processException(new \Exceptions\InternalException("Function \"".$name."\" already exist in package \"".$this->functions[$name]["packageName"]."\" (duplicate in package \"".$packageName."\")"));
        }

        $request = str_replace('/', '\\', $request);

        $this->functions[$name] = array(
            "funcName" => $funcName ? $funcName : $name,
            "request" => $request ? $request : null,
            "package" => $package,
            "packageName" => $packageName,
            "secured" => $securityLevel,
            "description" => $description
        );

        return true;
    }

    //Сначала парсит массив в реквест, затем вызывает процессРеквест
    public function processFunction($functionName, $infoArray){
        if (!$this->functions || !array_key_exists($functionName, $this->functions)){
            $this->processException(new \Exceptions\InternalException("Function ".$functionName." does not exist"));
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

        $package = $this->functions[$functionName]['package'];

        if (!method_exists($package, $functionName)){
            $this->processException(new \Exceptions\InternalException("No such function ".$functionName));
        }

        $ret = $package->$functionName();
        if (is_object($ret)) {
            try {
                $ret = $ret->Run($request);
                if ($ret instanceof SourceFacade){
                    $ret = $ret->data;
                }
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

    public function getApiReference(){
        $reference = array();
        if ($this->packages){
            foreach ($this->packages as $key => $value) {
                $newReference = array(
                    'Name' => $key,
                    'Functions' => array()
                );

                $functions = $value->getFunctions();
                if ($functions) {
                    foreach ($functions as $key => $value) {
                        $requestPath = str_replace('/', '\\', $value['Request']);

                        $request = new $requestPath;
                        $methods = get_class_methods ($request);
                        $argumentsList = array();

                        foreach($methods as $method){
                            $isGet = (strtolower(substr($method, 0, 3)) == 'get');
                            if ($isGet){
                                $defValue = $request->$method();
                                $type = 'Mixed';
                                if (is_array($defValue)){
                                    $type = 'Array';
                                }

                                if (is_string($defValue)){
                                    $type = 'String';
                                }

                                if (is_numeric($defValue)){
                                    $type = 'Numeric';
                                }

                                $argumentsList[] = array(
                                    'Name' => substr($method, 3),
                                    'Type' => $type
                                );
                            }
                        }


                        $newReference['Functions'][] = array(
                            'Name' => $value['Name'],
                            'Description' => $value['Description'],
                            'SecurityLevel' => $value['SecurityLevel'],
                            'Arguments' => $argumentsList
                        );
                    }
                }

                $reference[] = $newReference;
            }

            return $reference;
        }
        return array();
    }

    final public function processException(\Exception $e){
        $e = $this->getSecurityLayer()->checkException($e);

        throw $e;
    }

    final protected function build(){
        $this->doLoads();
    }
}