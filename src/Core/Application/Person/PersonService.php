<?php


namespace App\Core\Application\Person;


use App\Core\Application\Person\Query\FindByNameQuery;
use App\Core\Domain\Person\Person;
use App\Core\Domain\Person\PersonRepositoryInterface;

class PersonService implements PersonServiceInterface
{
    private $personRepository;

    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function findByName(FindByNameQuery $query): Person
    {
        return $this->personRepository->findByName($query->name());
    }
}