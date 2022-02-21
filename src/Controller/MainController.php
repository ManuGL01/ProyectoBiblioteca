<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\SecurityController;
use App\Entity\User;


class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        // if($this->isGranted('ROLE_ADMIN'))
        return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);
        // else {
        //     return $this->render('main/index.html.twig', [
        //         'user' => $this->getUser(),
        //     ]);
        // }
    }
}
