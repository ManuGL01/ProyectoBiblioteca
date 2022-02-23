<?php

namespace App\Controller;

use App\Repository\ComentarioRepository;
use App\Repository\LibroRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api')]
class APIController extends AbstractController
{
    #[Route('/libros', name: 'api_libros')]
    public function index(LibroRepository $libroRepository):Response
    {
        $libros = $libroRepository
            ->findAll();

        return $this->json($libros, Response::HTTP_OK, [], ['groups' => 'infoLibros']);
        /* return $this->json([
            'message' => 'OK',
        ]); */
    }

    #[Route('/login', name: 'api_login')]
    public function login(#[CurrentUser] ?User $user): Response
    {
        return $this->json([
            'user' => $this->getUser() ? $this->getUser()->getId() : null]
        );
    }
}