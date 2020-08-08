<?php


namespace App\Core\Domain\Person;


class Person
{

    private string $firstname;
    private string $lastname;

    public function __construct(string $firstname, string $lastname)
    {

        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function fullname(): string
    {
        return $this->firstname.' '.$this->lastname;
    }

    public function name(): string
    {
        return $this->lastname;
    }
}