<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
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
        // Traitement des données soumises au formulaire
        $form->handleRequest($request);

        // je recupere les données transmises si le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération de l'entité Contact associée au formulaire
            $contact = $form->getData();

            // Récupération des propriétés de l'entité Contact
            $address = $contact->getEmail();
            // $content = $contact->getMessage();
            $subject = $contact->getObjet();
            $content = 'objet : ' . $contact->getObjet() . "\n";
            $content .= 'email : ' . $contact->getEmail() . "\n";
            $content .= 'message : ' . $contact->getMessage();

            // dd($contact);
            // $email = $data;
            // $adress = $data['email'];
            // $content = $data['message'];
            // $content = $data['objet'];
            // $adress = $data->getEmail();
            // $content = $data->getMessage();


            $email = (new Email())
                ->from($address)
                ->to('admin@admin.com')
                ->subject($subject)
                ->text($content);

            // Avant l'envoi de l'email
            // dd($email);
            $mailer->send($email);
            // Après l'envoi de l'email
            // var_dump('Email envoyé avec succès');
            // dd($mailer);

            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('contact/index.html.twig', [
            // 'form' => $form->createView(),
            'form' => $form
        ]);
    }
}
