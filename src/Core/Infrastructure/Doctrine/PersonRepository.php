<?php


namespace App\Core\Infrastructure\Doctrine;

use App\Core\Domain\Person\Person;
use App\Core\Domain\Person\PersonRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class PersonRepository implements PersonRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Person::class);
    }

    public function add(Person $person): Person
    {
        $this->entityManager->persist($person);
        $this->entityManager->flush();

        return $person;
    }

    public function findByName(string $name): Person
    {
        return $this->repository->findOneBy(['lastname' => $name]);
    }
}
