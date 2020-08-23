<?php


namespace App\Core\Infrastructure\InMemory;

use App\Core\Domain\Person\Person;
use App\Core\Domain\Person\PersonRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

class PersonRepository implements PersonRepositoryInterface
{
    private ArrayCollection $data;

    public function __construct()
    {
        $this->data = new ArrayCollection();
    }

    public function add(Person $person): Person
    {
        $this->data->add($person);

        return $person;
    }

    public function findByName(string $name): Person
    {
        $result = $this->data->filter(
            fn (Person $p) => $p->name() === $name ? $p : null
        );
        return $result->first();
    }
}
