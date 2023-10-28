<?php

namespace App\Controller;

use App\Form\ContactFormType;
// use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);
        // ...
        // je traite les données soumises au 
        $form->handleRequest($request);

        // je recupere les données transmises si le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // dd($data);
            $email = $data;
            $adress = $data->getEmail();
            $content = $data->getMessage();
            // $adress = $data('email');
            // $content = $data('message');

            $email = (new Email())
            ->from($adress)
            ->to('admin@admin.com')
            ->subject('objet')
            ->text($content);

            $mailer->send($email);

            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('contact/index.html.twig', [
            // 'form' => $form->createView(),
            'form' => $form
        ]);
    }
}
