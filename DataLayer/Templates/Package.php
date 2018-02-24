<?php
namespace DataLayer\Templates;

class Package extends \Engine\Package {
    public function getTemplate(){
        return new Functions\GetTemplate();
    }

    public function getTitle(){
        return new Functions\GetTitle();
    }


    public function render(){
        $getTemplate = $this->getTemplate();
        $getTitle = $this->getTitle();

        return new Functions\Render($getTemplate, $getTitle);
    }

    public function getFunctions(){
        return array(
            $this->f("render", "/DataLayer/Templates/Requests/Render", "Gives arguments to the defined template and returns result")
        );
    }
}
























