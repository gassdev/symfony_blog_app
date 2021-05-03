<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    /**
     * @Route("/hello")
     *
     * @return Response
     */
    public function hello(): Response
    {
        return new Response('Hello world');
    }

    /**
     * @Route("/hello/{name}")
     *
     * @param  mixed $name
     * @return Response
     */
    public function helloName($name): Response
    {
        return new Response("Hello $name");
    }
}