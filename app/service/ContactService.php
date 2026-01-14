<?php
require_once __DIR__ . '/../model/Contact.php';

class ContactService
{
    private Contact $contact;

    public function __construct()
    {
        $this->contact = new Contact();
    }

    public function getAll()
    {
        return $this->contact->getAll();
    }

    public function getById($id)
    {
        return $this->contact->getById($id);
    }

    public function create($name, $email, $message)
    {
        return $this->contact->create($name, $email, $message);
    }


    public function delete($id)
    {
        return $this->contact->delete($id);
    }
}
