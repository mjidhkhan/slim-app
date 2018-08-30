<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->info("HomeController '/' /");

        return $this->view->render($response, 'index.twig', $args);
    }
}
