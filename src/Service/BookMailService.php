<?php

namespace App\Service;

use App\Entity\Carshare;
use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;

class BookMailService
{
     private string $projectDir;
    private MailerInterface $mailer;
    private LoggerInterface $logger;
    private User $user;
    public function __construct(
        MailerInterface $mailer,
        string $projectDir,
        LoggerInterface $logger
    ) {
        $this->mailer = $mailer;
        $this->projectDir = $projectDir;
        $this->logger = $logger;
    }
    public function getUser(): User
    {
        return $this->user;
    }
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function generateBookingEmail(): void
    {
        try {
            // Verify the ticket file exists
            $ticketPath = $this->projectDir . '/public/tickets/ticket.pdf';

            if (!file_exists($ticketPath)) {
                $this->logger->error('Ticket file not found: ' . $ticketPath);
                throw new \RuntimeException('Ticket file not found');
            }

            $email = (new Email())
                ->from(new Address('noreply@ecoride.com', 'EcoRide'))
                ->to(new Address($this->user->getEmail(), $this->user->getFirstName()))
                ->subject('Booking Confirmation')
                ->addPart(new DataPart(new File($ticketPath,'Booking ticket')))
                ->html($this->getEmailContent());

            $this->mailer->send($email);
            $this->logger->info('Booking confirmation email sent to ' . $this->user->getEmail());

        } catch (\Exception $e) {
            $this->logger->error('Failed to send booking email: ' . $e->getMessage());
            // Re-throw the exception or handle it as needed
            throw $e;
        }
    }
        private function getEmailContent(): string
    {
        return '<p>Dear ' . htmlspecialchars($this->user->getFirstName()) . ',</p>
                <p>Your booking has been confirmed.</p>
                <p>Thank you for choosing EcoRide!</p>
                <p>Your ticket is attached to this email.</p>';
    }
}