<?php


namespace App\Core\Domain\Person;


interface PersonRepositoryInterface
{
    public function findByName(string $name): Person;
}