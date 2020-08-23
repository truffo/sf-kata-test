<?php namespace App\Tests\Core\Infrastructure;

use App\Core\Domain\Person\Person;
use App\Core\Domain\Person\PersonRepositoryInterface;
use App\Core\Infrastructure\InMemory\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;

class PersonRepositoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \App\Tests\InfrastructureTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testAdd()
    {
        foreach ($this->personRepositoryGenerator() as $repo) {
            $person = new Person('Bob', 'Leponge');
            $result = $repo->add($person);
            $this->tester->assertNotNull($result);
            $this->tester->assertEquals($result->name(), $person->name());
        }
    }

    public function testFindByName()
    {
        foreach ($this->personRepositoryGenerator() as $repo) {
            $repo->add(new Person('Bob', 'Leponge'));
            $result = $repo->findByName('Leponge');
            $this->tester->assertInstanceOf(Person::class, $result);
        }
    }

    /**
     * @return iterable|PersonRepositoryInterface[]
     */
    public function personRepositoryGenerator(): iterable
    {
        $entityManager = $this->tester->grabService(EntityManagerInterface::class);
        yield new \App\Core\Infrastructure\InMemory\PersonRepository();
        yield new \App\Core\Infrastructure\Doctrine\PersonRepository($entityManager);
    }
}
