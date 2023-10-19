<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\DiscRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    private $artistRepo;
    private $discRepo;
    // private $em;

    public function __construct(ArtistRepository $artistRepo, DiscRepository $discRepo)
    {
        $this->artistRepo = $artistRepo;
        $this->discRepo = $discRepo;
        // $this->em = $em;

    }

    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        $artists = $this->artistRepo->findAll();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'artists' => $artists

        ]);
    }
}
