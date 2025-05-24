<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class BookingEmailController extends AbstractController{
    #[Route('/booking/email', name: 'app_booking_email')]
    public function sendEmail(MailerInterface $mailer, User $user): Response
    {
        $email = (new Email())
            ->from('sender@example.com')
            ->to($user->getEmail())
            ->subject('Automated Email')
            ->text('Your booking has been confirmed.')
            ->html('<p>Your booking is confirmed</p>');

        $mailer->send($email);

        return new Response('Email sent successfully!');
    }
}
