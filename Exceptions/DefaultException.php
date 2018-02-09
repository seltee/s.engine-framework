<?php
namespace Exceptions;

use Throwable;

$function = 0;

class DefaultException extends \Engine\Exception {
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function addAdditionalData($data){
        $this->setAdditionalData($data);
        return $this;
    }

    protected $additionalData = null;

    /**
     * @return mixed
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * @param mixed $additionalData
     */
    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
    }
}