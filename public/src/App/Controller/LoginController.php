<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class LoginController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->container->logger->info("LoginController '/' login/");

        return $this->container->view->render($response, 'login.twig', $args);
    }
}
