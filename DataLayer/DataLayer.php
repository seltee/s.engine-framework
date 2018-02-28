<?php

namespace DataLayer;

class DataLayer extends \Engine\DataLayer {
    protected function doLoads(){
        $this->loadPackage("Templates");
        $this->loadPackage("Main");
        $this->loadPackage("Users");
        $this->loadPackage("Gallery");
        $this->loadPackage("News");
        $this->loadPackage("Slider");
        $this->loadPackage("CSV");
    }

    protected function getSecurityLayer(){
        return new \DataLayer\SecurityLayer();
    }

    /*
    public function processException(\Exception $e){
        if ($e instanceof \Exceptions\DefaultException){
            if ($this->getIsDatapoint()) {
                $message = array('errorMessage' => $e->getMessage());
                if ($e->getAdditionalData()) {
                    $message['data'] = $e->getAdditionalData();
                }

                $this->answer($message, $e->getCode());
            }else{
                $request = new \DataLayer\Templates\Requests\Render();
                $request->setTemplateName('exception');
                $request->setParameters(array(
                    'message' => $e->getMessage()
                ));
                $result = $this->processRequest('render', $request, false);
                $this->answer($result['data'], $e->getCode());
            }
        }

        if ($e instanceof \Exceptions\Page404){
            //$this->answer('404', $e->getCode());
            $request = new \DataLayer\Main\Requests\Render();
            $request->setTemplateName('page404');
            $result = $this->processRequest('render', $request);
            $this->answer($result['data'], $e->getCode());
        }

        if ($e instanceof \Exceptions\UnderConstruction){
            if ($this->getIsDatapoint()){
                $this->answer(null, $e->getCode(), true);
            }else {
                $request = new \DataLayer\Main\Requests\Render();
                $request->setTemplateName('under_construction');
                $result = $this->processRequest('render', $request, false);
                $this->answer($result['data'], $e->getCode());
            }
        }

        $this->answer($e->getMessage(), $e->getCode());
    }
    */

    /*
    protected function answer($message, $code, $needReload = false){
        if ($this->getIsDatapoint()){
            $object = new \stdClass();
            $object->error = true;
            $object->message = $message;
            $object->code = $code;
            if ($needReload){
                $object->needReload = true;
            }

            die(json_encode($object));
        }else{
            if (is_array($message)){
                die($message['errorMessage']);
            }else{
                die($message);
            }
        }
    }
    */
}