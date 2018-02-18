<?php
namespace Engine;

abstract class Package
{
    abstract public function getFunctions();

    public function getPackageByName($name){
        $class = "DataLayer\\$name\\Package";
        return new $class;
    }

    public function f($name, $request, $description, $securityLevel = 0){
        return array(
            "Name" => $name,
            "Request" => $request,
            "Description" => $description,
            "SecurityLevel" => $securityLevel
        );
    }
}