<?php

namespace App\Controller;

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

    #[Route('/addcomment', name: 'api_add_comment')]
    public function addComment(PostRepository $postRepository, EntityManagerInterface $entityManager, Request $request):Response
    {
        $data = json_decode($request->getContent(), true);
        $postId = $data['postId'];
        $content = $data['content'];
        
        $comment = new Comment();
        $post = $postRepository
            ->findOneBy(
                ['id' => $postId]
            );

        $comment->setPost($post);
        $comment->setAuthor($this->getUser());
        $comment->setHidden(false);
        $comment->setContent($content);

        $entityManager->persist($comment);
        $entityManager->flush();
        
        return $this->json([
            'message' => 'OK',
            'postId' => $postId,
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