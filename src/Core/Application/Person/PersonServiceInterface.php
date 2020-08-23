<?php


namespace App\Core\Application\Person;

use App\Core\Application\Person\Query\FindByNameQuery;
use App\Core\Domain\Person\Person;

interface PersonServiceInterface
{
    public function findByName(FindByNameQuery $query): Person;
}
