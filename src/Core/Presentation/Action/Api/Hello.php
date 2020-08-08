<?php


namespace App\Core\Presentation\Action\Api;

use App\Core\Application\Person\PersonServiceInterface;
use App\Core\Application\Person\Query\FindByNameQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/v1/hello/{name}", name="hello", methods="GET" )
 */
class Hello
{
    private $personService;

    public function __construct(PersonServiceInterface $personService)
    {
        $this->personService = $personService;
    }

    public function __invoke(string $name = ''): Response
    {
        if ('' === $name) {
            return new Response('Hello world');
        }
        $person = $this->personService->findByName(new FindByNameQuery($name));
        return new Response('Hello '.$person->fullname());
    }
}