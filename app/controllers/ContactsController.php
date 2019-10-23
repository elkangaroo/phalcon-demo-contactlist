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
            $this->flashSession->error('Contact creation failed: ' . implode($contact->getMessages(), "\n"));
        } else {
            $this->flashSession->success('A contact has been created with id ' . $contact->id);
        }

        return $this->response->redirect('/contacts');
    }

    public function updateAction(int $id)
    {
        $contact = Contacts::findFirst($id);

        if (null === $contact) {
            return $this->response->setStatusCode(404, 'Not Found');
        }

        $form = new ContactsForm($contact);
        $form->bind($_POST, $contact);

        if ($this->request->isPost() && $form->isValid()) {
            if (false == $contact->save()) {
                $this->flashSession->error('Contact update failed: ' . implode($contact->getMessages(), "\n"));
            } else {
                $this->flashSession->success('Contact with id ' . $contact->id . ' has beend updated.');
                return $this->response->redirect('/contacts');
            }
        }

        $this->view->form = $form;
        $this->view->contact = $contact;
    }

    public function deleteAction(int $id)
    {
        $contact = Contacts::findFirst($id);

        if (null === $contact) {
            return $this->response->setStatusCode(404, 'Not Found');
        }

        if (false == $contact->delete()) {
            $this->flashSession->error('Contact deletion failed: ' . implode($contact->getMessages(), "\n"));
        } else {
            $this->flashSession->success('Contact with id ' . $contact->id . ' has beend deleted.');
        }

        return $this->response->redirect('/contacts');
    }
}

