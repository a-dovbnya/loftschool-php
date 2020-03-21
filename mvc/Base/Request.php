<?php
namespace Base;

class Request
{
    private $_controllerName = '';
    private $_actionName = '';

    public function __construct()
    {
        $parts = explode('/', $_SERVER['REQUEST_URI']);
        $this->_controllerName = $parts[2] ?? '';
        $this->_actionName = $parts[3] ?? '';
    }

    public function getControllerName(): string
    {
        return $this->_controllerName;
    }

    public function getActionName(): string
    {
        return $this->_actionName;
    }
}