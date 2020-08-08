<?php namespace App\Tests\Infrastructure;

use App\Core\Domain\Person\Person;

class PersonRepositoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \App\Tests\IntegrationTester
     */
    protected $tester;



    protected function _before()
    {
    }

    protected function _after()
    {
    }


    public function testSomeFeature()
    {
        foreach ($this->personRepositoryGenerator() as $repo) {
            $repo->add(new Person('Bob', 'Leponge'));
            $result = $repo->findByName('Leponge');
            $this->tester->assertInstanceOf(Person::class, $result);
        }
    }

    public function personRepositoryGenerator()
    {
        yield new \App\Core\Infrastructure\InMemory\PersonRepository();
    }
}