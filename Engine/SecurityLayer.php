<?php

namespace Engine;

/**
 * Created by PhpStorm.
 * User: Drakiny
 * Date: 23.08.2017
 * Time: 21:57
 */
abstract class SecurityLayer
{
    abstract function checkException(\Exception $e);
    abstract function check($functionInfo, $request, $dataLayer, $checkSecurity = true);
}