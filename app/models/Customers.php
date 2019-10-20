<?php

use Phalcon\Mvc\Model;

class Customers extends Model
{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $createdAt;
}

