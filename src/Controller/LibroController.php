<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Form\LibroType;
use App\Form\LibrosType;
use App\Repository\LibroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/libro')]
class LibroController extends AbstractController
{
    #[Route('/', name: 'libro_index', methods: ['GET'])]
    public function index(LibroRepository $libroRepository): Response
    {
        return $this->render('libro/index.html.twig', [
            'libros' => $libroRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'libro_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $libro = new Libro();
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        // $multipleForm =$this->createForm(LibrosType::class, $libro);
        // $multipleForm->handleRequest($request);

        // $bookFile = $form->get('book')->getData();
        $multipleBook = $form->get('book')->getData();

        // UN SOLO LIBRO FORM
        if ($form->isSubmitted() && $form->isValid()) {

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($multipleBook) {
                try {
                foreach ($multipleBook as $multipleBookFile) {
                $libro = new Libro();
                $originalFilename = pathinfo($multipleBookFile->getClientOriginalName(), PATHINFO_FILENAME);
                $originalFilename->replaceMatches('/[^._,]++/', ' ');
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$multipleBookFile->guessExtension();
                $datosLibro = explode("-", $originalFilename);

                // Move the file to the directory where brochures are stored
                
                    $multipleBookFile->move(
                        $this->getParameter('books_directory').strtoupper(substr($datosLibro[0], 0, 1)),
                        $newFilename
                    );
                    $libro->setTitulo($datosLibro[0]);
                    $libro->setAutor($datosLibro[1]);
                    $libro->setUrl($newFilename);
        
                    $entityManager->persist($libro);
                    $entityManager->flush();
                }
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imageFilename' property to store the PDF file name
                // instead of its contents
                
            }


            return $this->redirectToRoute('libro_new', [], Response::HTTP_SEE_OTHER);
        }

        // VARIOS LIBROS FORM INTENTO DE CSV
        // if ($multipleForm->isSubmitted() && $multipleForm->isValid()) {

        //     // this condition is needed because the 'brochure' field is not required
        //     // so the PDF file must be processed only when a file is uploaded
        //     if ($multipleBook) {
        //         try {
        //             foreach ($multipleBook as $multipleBookFile) {
        //         $originalFilename = pathinfo($multipleBookFile->getClientOriginalName(), PATHINFO_FILENAME);
        //         // this is needed to safely include the file name as part of the URL
        //         $safeFilename = $slugger->slug($originalFilename);
        //         $newFilename = $safeFilename.'-'.uniqid().'.'.$multipleBookFile->guessExtension();
        //         $datosLibro = explode("-", $originalFilename);
 
        //         // Move the file to the directory where brochures are stored
                
        //             $multipleBookFile->move(
        //                 $this->getParameter('bookscsv_directory').strtoupper(substr($datosLibro[0], 0, 1)),
        //                 $newFilename
        //             );
        //         }
        //     }
        //          catch (FileException $e) {
        //             // ... handle exception if something happens during file upload
        //         }

        //         // updates the 'imageFilename' property to store the PDF file name
        //         // instead of its contents
        //     }
        //     // if (($open = fopen("bookscsv/" . $newFilename , "r"))!==false) {
        //     //     while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {  
        //     //         $libro = new Libro();
        //     //         $libro->setTitulo($data[0]);
        //     //         $libro->setAutor($data[1]);
        //     //         $libro->setUrl($data[0]);  
        //     //         $entityManager->persist($libro);
        //     //         $entityManager->flush();
        //     //     }
        //     // }
        //     // fclose($open);


        //     // return $this->redirectToRoute('libro_new', [], Response::HTTP_SEE_OTHER);
        // }

        return $this->renderForm('admin/newBook.html.twig', [
            'libro' => $libro,
            'form' => $form,
            // 'multipleForm' => $multipleForm,
        ]);
    }

    #[Route('/{id}', name: 'libro_show', methods: ['GET'])]
    public function show(Libro $libro): Response
    {
        return $this->render('libro/show.html.twig', [
            'libro' => $libro,
        ]);
    }

    #[Route('/{id}/edit', name: 'libro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Libro $libro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('libro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('libro/edit.html.twig', [
            'libro' => $libro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'libro_delete', methods: ['POST'])]
    public function delete(Request $request, Libro $libro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$libro->getId(), $request->request->get('_token'))) {
            $entityManager->remove($libro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('libro_index', [], Response::HTTP_SEE_OTHER);
    }
}
