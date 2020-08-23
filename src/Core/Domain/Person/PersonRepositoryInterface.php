<?php


namespace App\Core\Domain\Person;

interface PersonRepositoryInterface
{
    public function add(Person $person): Person;

    public function findByName(string $name): Person;
}
