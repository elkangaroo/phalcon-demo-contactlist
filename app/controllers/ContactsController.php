<?php

use Phalcon\Mvc\Controller;

class ContactsController extends Controller
{
    public function indexAction()
    {
        $this->view->contacts = Contacts::find();
    }

    public function createAction()
    {
        $faker = Faker\Factory::create();

        $contact = new Contacts();
        $contact->first_name = $faker->firstName;
        $contact->last_name = $faker->lastName;
        $contact->email = $faker->email;
        $contact->created_at = (new \DateTime())->format(\DateTime::ATOM);
        if (false === $contact->save()) {
            echo 'Nooo...' . "\n";
            foreach ($contact->getMessages() as $message) {
                echo $message . "\n";
            }
        } else {
            echo 'Yeah!';
        }

        $this->response->redirect('/contacts');
        $this->view->disable();
    }
}

