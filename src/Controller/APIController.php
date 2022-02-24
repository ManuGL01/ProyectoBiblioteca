<?php

namespace App\Controller;

use App\Entity\Comentario;
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
    public function libros(LibroRepository $libroRepository):Response
    {
        $libros = $libroRepository
            ->findAll();

        return $this->json($libros, Response::HTTP_OK, [], ['groups' => 'infoLibros']);
    }

    #[Route('/anadirComentario', name: 'api__comment')]
    public function addComment(LibroRepository $libroRepository, EntityManagerInterface $entityManager, Request $request):Response
    {
        $data = json_decode($request->getContent(), true);
        $libroId = $data['libroId']; //viene del json
        $contenidoComentario = $data['comentario']; //viene del json
        
        $comentario = new Comentario();
        $libro = $libroRepository
            ->findOneBy(
                ['id' => $libroId]
            );

        $comentario->setLibro($libro);
        $comentario->setAutor($this->getUser());
        $comentario->setFechaPublicacion(new \DateTime());
        $comentario->setComentario($contenidoComentario);

        $entityManager->persist($comentario);
        $entityManager->flush();
        
        return $this->json([
            'message' => 'OK',
            'libroId' => $libroId,
        ]);
    }

    #[Route('/login', name: 'api_login')]
    public function login(): Response
    {
        // a jalal le dice que getId() no existe? oosas del tabnine o de php o algo?
        return $this->json([
            'user' => $this->getUser() ? $this->getUser()->getId() : null]
        );
    }
}