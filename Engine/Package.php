<?php
namespace Engine;

abstract class Package
{
    public function getPackageByName($name){
        $class = "DataLayer\\$name\\Package";
        return new $class;
    }
}