<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;

class ContactsForm extends Form
{
    public function initialize($entity = null, $options = [])
    {
        $this->add(
            new Text('first_name')
        );
        $this->add(
            new Text('last_name')
        );
        $this->add(
            new Text('email')
        );
    }
}

