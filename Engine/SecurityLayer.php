<?php

namespace Engine;

abstract class SecurityLayer
{
    abstract function checkException(\Exception $e);
    abstract function check($functionInfo, $request, $dataLayer, $checkSecurity = true);
}