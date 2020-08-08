<?php

namespace App\Tests\Core\Application\Person;

use App\Core\Application\Person\PersonService;
use App\Core\Application\Person\Query\FindByNameQuery;
use App\Core\Domain\Person\Person;
use App\Core\Infrastructure\InMemory;

class PersonServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \App\Tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testFindByNameStub()
    {
        $personRepository = new InMemory\PersonRepository();
        $personRepository->add(new Person('Peter', 'Pan'));
        $service = new PersonService($personRepository);

        $result = $service->findByName(new FindByNameQuery('Pan'));

        $this->tester->assertInstanceOf(Person::class, $result);
        $this->tester->assertEquals('Peter Pan', $result->fullname());
    }

    public function testFindByNameMock()
    {
        $personRepository = $this->createMock(\App\Core\Domain\Person\PersonRepositoryInterface::class);
        $personRepository
            ->expects($this->once())
            ->method('findByName')
            ->willReturn(new Person('Peter', 'Pan'));

        $service = new PersonService($personRepository);

        $result = $service->findByName(new FindByNameQuery('Pan'));

        $this->tester->assertInstanceOf(Person::class, $result);
        $this->tester->assertEquals('Peter Pan', $result->fullname());
    }
}