<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EmailController extends AbstractController
{
    /**
     * @Route("/email", name="email")
     */
    public function index($name, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('wanderlust.we.009@gmail.com')
            ->setTo('raghavrastogi09@gmail.com')
            ->setBody(
                $this->renderView(
                    // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    ['name' => $name]
                ),
                'text/html'
            );

        $mailer->send($message);

        return new Response('email sent !!!!');
    }


}
