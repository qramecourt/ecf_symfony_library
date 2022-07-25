<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EditorRepository;
use App\Repository\AuthorRepository;

class DbTestController extends AbstractController
{
    #[Route('/db/test', name: 'app_db_test')]
    public function index(): Response
    {
        return $this->render('db_test/index.html.twig', [
            'controller_name' => 'DbTestController',
        ]);
    }
}
