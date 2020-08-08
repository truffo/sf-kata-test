<?php namespace App\Tests\App\Core\Application\Person;

use App\Core\Application\Person\PersonService;
use App\Core\Application\Person\Query\FindByNameQuery;
use App\Core\Domain\Person\Person;
use App\Core\Infrastructure\InMemory\PersonRepository;

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

    // tests
    public function testFindByName()
    {
        $personRepository = new PersonRepository();
        $personRepository->add(new Person('Peter', 'Pan'));
        $service = new PersonService($personRepository);

        $result = $service->findByName(new FindByNameQuery('Pan'));

        $this->tester->assertInstanceOf(Person::class, $result);
        $this->tester->assertEquals('Peter Pan', $result->fullname());
    }
}