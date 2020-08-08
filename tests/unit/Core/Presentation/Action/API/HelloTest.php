<?php namespace App\Tests\Core\Presentation\Action\Api;

use App\Core\Application\Person\PersonServiceInterface;
use App\Core\Domain\Person\Person;
use App\Core\Presentation\Action\Api\Hello;
use Symfony\Component\HttpFoundation\Response;

class HelloTest extends \Codeception\Test\Unit
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
    public function testHello()
    {
        $service = $this->createMock(PersonServiceInterface::class);
        $action = new Hello($service);
        $result = $action();

        $this->tester->assertInstanceOf(Response::class, $result);
        $this->tester->assertEquals($result->getContent(), 'Hello world');
        $this->tester->assertEquals(Response::HTTP_OK, $result->getStatusCode());
    }

    public function testHelloWithName()
    {
        $service = $this->createMock(PersonServiceInterface::class);
        $service
            ->expects($this->once())
            ->method('findByName')
            ->willReturn(new Person('Peter', 'Pan'));

        $action = new Hello($service);

        $result = $action('Pan');

        $this->tester->assertInstanceOf(Response::class, $result);
        $this->tester->assertEquals($result->getContent(), 'Hello Peter Pan');
        $this->tester->assertEquals(Response::HTTP_OK, $result->getStatusCode());
    }
}