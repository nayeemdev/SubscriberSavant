<?php

namespace App\DTO;

class SubscriberDTO
{
    public $id;
    public $name;
    public $email;
    public $country;

    public function __construct($id, $name, $email, $country)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->country = $country;
    }
}
