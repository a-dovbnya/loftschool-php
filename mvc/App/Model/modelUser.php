<?php
namespace App\Model;

class modelUser
{
    private $_id = '123456';
    private $_name = 'Петя';

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id): void
    {
        $this->_id = $id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($name): void
    {
        $this->_name = $name;
    }
}