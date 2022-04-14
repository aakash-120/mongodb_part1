<?php

use Phalcon\Incubator\MongoDB\Mvc\Collection;

class RobotsCollection extends Collection
{
    public $code;

    public $theName;

    public $theType;

    public $theYear;
}

$robots = new RobotsCollection($data);