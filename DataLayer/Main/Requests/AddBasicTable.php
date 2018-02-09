<?php
namespace DataLayer\Main\Requests;

class AddBasicTable extends \Requests\Dummy {
    protected $identifier = "";

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }
}