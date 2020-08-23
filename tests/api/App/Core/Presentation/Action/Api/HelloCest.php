<?php namespace App\Tests\App\Core\Presentation\Api;

use App\DataFixtures\PersonFixtures;
use App\Tests\ApiTester;
use Codeception\Util\Fixtures;
use Codeception\Util\HttpCode;
use Doctrine\Bundle\FixturesBundle\Fixture;

class HelloCest
{
    public function _before(ApiTester $I)
    {
        $I->loadFixtures(PersonFixtures::class, false);
    }

    public function hello(ApiTester $I)
    {
        $I->sendGET('/api/v1/hello');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContains('Hello world');
    }

    public function helloWithName(ApiTester $I)
    {
        $I->sendGET('/api/v1/hello/'.urlencode('Thomas'));
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContains('Hello Raymond Thomas');
    }
}
