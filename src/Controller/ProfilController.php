<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    private $userRepo;

    public function __construct(UtilisateurRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        // on récupère l'identifiant unique de l'utilisateur connecté 
        $identifiant = $this->getUser()->getUserIdentifier();
        if ($identifiant) {
            // vérifie qu'on a bien un utilisateur dans la base de donnée qui a ce mail 
            $info = $this->userRepo->findOneBy(["email" => $identifiant]);
            // $info = ['lastname' => 'Loper', 'firstname' => 'Dave', 'email' => 'daveloper@code.dom', 'birthdate' => '01/01/1970'];
        }

        return $this->render('profil/index.html.twig', [
            'informations' => $info
        ]);
    }
}
