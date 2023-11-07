<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/admin', name: 'app_products')]
    public function index(): Response
    {
        return $this->render('admin/products/index.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }

    #[Route('/ajout', name: 'app_add')]
    public function add(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/products/index.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_delete')]
    public function delete(): Response
    {
        return $this->render('admin/products/index.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }

}
