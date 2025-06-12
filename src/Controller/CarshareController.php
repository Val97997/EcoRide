<?php

namespace App\Controller;

use App\Entity\Carshare;
use App\Entity\User;
use App\Enum\CarshareStatus;
use App\Form\CarshareType;
use App\Repository\CarshareRepository;
use App\Service\BookMailService;
use Doctrine\ORM\EntityManagerInterface;
use Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/carshare')]
final class CarshareController extends AbstractController{

    #[Route('/new', name: 'app_carshare_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response|Error
    {
        $carshare = new Carshare();
        $form = $this->createForm(CarshareType::class, $carshare);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('arrival_date')->getData() < $form->get('departure_date')->getData() ||
               $form->get('arrival_hour')->getData() < $form->get('departure_hour')->getData()
            ){
                $form->addError(new FormError('Invalid dates, check your inputs'));
            }
            else{
                // !! don't forget to set the carshare to waiting status and add driver as User owner
                $carshare->setUser($this->getUser());
                $entityManager->persist($carshare);
                $entityManager->flush();
    
                // flash message on redirect :
                $this->addFlash('carshare-saved', 'New route saved and published');
                $request->getSession()->set('redirect_from', '/carshare/new');
                return $this->redirectToRoute('app_user_profile', [], Response::HTTP_PERMANENTLY_REDIRECT);

            }
        }
        
        return $this->render('carshare/new.html.twig', [
            'carshare' => $carshare,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_carshare_show', methods: ['GET'])]
    // public function show(Carshare $carshare): Response
    // {
    //     return $this->render('carshare/show.html.twig', [
    //         'carshare' => $carshare,
    //     ]);
    // }

    #[Route('/cancel/{id}', name: 'app_carshare_cancel', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carshare $carshare, EntityManagerInterface $entityManager, BookMailService $bookMailService): Response
    {
        $user = $this->getUser();
        // restitute the spent credits to the passengers :
        $passengers = $carshare->getPassengers();
        $entityManager->persist($carshare);
        $carshare->setStatus(CarshareStatus::CANCELED);
        if($passengers != null){
            foreach($passengers as $pass){

                $credits = $pass->getCreditBalance()+ round(($carshare->getPrice())/10);
                $pass->setCreditBalance($credits);

                // send mail notifying them :
                $bookMailService->setUser($pass);
                $bookMailService->generateCancelEmail($carshare);
            }
        }
        

        if($carshare->getUser() !== $user){
            return $this->redirectToRoute('app_403');
        }
        $entityManager->flush();

        $this->addFlash('carshare-cancel', 'Carshare has been canceled');
        $request->getSession()->set('redirect_from', '/carshare/cancel');

        
        return $this->redirectToRoute('app_user_profile', [
        
        ]);
    }
    #[Route('/book/cancel/{id}', name: 'app_carshare_cancel_booking', methods: ['GET', 'POST'])]
    public function cancelBook(Request $request, Carshare $carshare, EntityManagerInterface $em){
        
        return $this->render('default/index.html.twig');
    }

    #[Route('/start/{id}', name: 'app_carshare_start', methods: ['GET', 'POST'])]
    public function start(Request $request, Carshare $carshare, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if($carshare->getUser() !== $user){
            return $this->redirectToRoute('app_403');
        }
        $entityManager->persist($carshare);
        $carshare->setStatus(CarshareStatus::IN_PROGRESS);
        $entityManager->flush();

        $this->addFlash('carshare-start', 'Carshare has started');
        $request->getSession()->set('redirect_from', '/carshare/start');

        
        return $this->render('pages/profile.html.twig', [
        
        ]);
    }

    #[Route('/end/{id}', name: 'app_carshare_end', methods: ['GET', 'POST'])]
    public function end(Request $request, Carshare $carshare, EntityManagerInterface $entityManager, BookMailService $bookMailService): Response
    {
        $user = $this->getUser();
        // notify passengers of finished travel :
        $passengers = $carshare->getPassengers();
        $entityManager->persist($carshare);
        $carshare->setStatus(CarshareStatus::CANCELED);
        if($passengers != null){
            foreach($passengers as $pass){

                // send mail notifying them :
                $bookMailService->setUser($pass);
                $bookMailService->generateFinishEmail($carshare);
            }
        }

        if($carshare->getUser() !== $user){
            return $this->redirectToRoute('app_403');
        }
        $entityManager->persist($carshare);
        $carshare->setStatus(CarshareStatus::COMPLETE);
        $entityManager->flush();

        $this->addFlash('carshare-end', 'Carshare has ended');
        $request->getSession()->set('redirect_from', '/carshare/end');

        
        return $this->render('pages/profile.html.twig', [
        
        ]);
    }
}
