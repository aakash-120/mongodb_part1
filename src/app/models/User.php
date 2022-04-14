<?php
use Phalcon\Mvc\Collection;

class User extends Collection
{
    public function initialize()
    {
        $this->setSource('users');
    }
}


