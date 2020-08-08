<?php namespace App\Tests\App\Core\Presentation\Api;
use App\Tests\FunctionalTester;
use Codeception\Util\HttpCode;

class HelloCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }

    public function hello(FunctionalTester $I)
    {
        $I->sendGET('/api/v1/hello');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContains('Hello world');
    }

    public function helloWithName(FunctionalTester $I)
    {
        $I->sendGET('/api/v1/hello', ['name' => 'Pan']);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContains('Hello Peter Pan');
    }
}
