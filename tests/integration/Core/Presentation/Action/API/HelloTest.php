<?php namespace App\Tests\Core\Presentation\Action\Api;

use App\Core\Application\Person\PersonService;
use App\Core\Application\Person\PersonServiceInterface;
use App\Core\Domain\Person\Person;
use App\Core\Domain\Person\PersonRepositoryInterface;
use App\Core\Presentation\Action\Api\HelloAction;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class HelloTest extends \Codeception\Test\Unit
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

    // tests
    public function testHello()
    {
        $service = $this->tester->grabService(PersonServiceInterface::class);
        $action = new HelloAction($service);
        $result = $action();

        $this->tester->assertInstanceOf(Response::class, $result);
        $this->tester->assertEquals($result->getContent(), 'Hello world');
        $this->tester->assertEquals(Response::HTTP_OK, $result->getStatusCode());
    }

    /**
     * @group stub
     */
    public function testHelloWithNameWithStubs()
    {
        $person = new Person('Raymond', 'Thomas');
        $repo = $this->tester->grabService(PersonRepositoryInterface::class);
        $repo->add($person);

        $service =  $this->tester->grabService(PersonServiceInterface::class);
        $action = new HelloAction($service);

        $result = $action('Thomas');

        $this->tester->assertInstanceOf(Response::class, $result);
        $this->tester->assertEquals($result->getContent(), 'Hello Raymond Thomas');
        $this->tester->assertEquals(Response::HTTP_OK, $result->getStatusCode());
    }

    /**
     * @group mock
     */
    public function testHelloWithNameWithMock()
    {
        $personRepository = $this->createMock(\App\Core\Domain\Person\PersonRepositoryInterface::class);
        $personRepository
            ->expects($this->once())
            ->method('findByName')
            ->willReturn(new Person('Peter', 'Parker'));

        $service =  new PersonService($personRepository);
        $action = new HelloAction($service);

        $result = $action('Peter');

        $this->tester->assertInstanceOf(Response::class, $result);
        $this->tester->assertEquals($result->getContent(), 'Hello Peter Parker');
        $this->tester->assertEquals(Response::HTTP_OK, $result->getStatusCode());
    }
}
