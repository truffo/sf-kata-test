<?php namespace App\Tests\Core\Presentation\Controller\API;

use Symfony\Component\HttpFoundation\JsonResponse;

class HelloActionTest extends \Codeception\Test\Unit
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
    public function testInvoke()
    {
        $action = new Core\Presentation\Controller\API\HelloAction();

        /** @var JsonResponse $result */
        $result = $action();

        $this->tester->assertInstanceOf(JsonResponse::class);
        $this->tester->assertEquals('Hello world');
    }
}