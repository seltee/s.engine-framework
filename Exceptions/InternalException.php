<?php
namespace Exceptions;

use Throwable;

$function = 0;

class InternalException extends \Engine\Exception {
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Internal exception: '.$message, $code, $previous);
    }
}