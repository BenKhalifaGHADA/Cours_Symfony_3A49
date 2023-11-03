<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Form\AuthorType;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    public $authors = array(


        array(
            'id' => 1, 'picture' => '/images/Victor-Hugo.jpg',
            'username' => ' Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100
        ),
        array(
            'id' => 2, 'picture' => '/images/william-shakespeare.jpg',
            'username' => ' William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' => 200
        ),
        array(
            'id' => 3, 'picture' => '/images/Taha_Hussein.jpg',
            'username' => ' Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300
        ),
    );
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/author/{name}', name:'showAuthor')]
    public function showAuthor($name){
        return $this->render('author/showAuthor.html.twig',['name'=>$name]);
    }

    // Exercice 2 : Manipulation du tableau associatif, filtre et Structure conditionnelle
    #[Route('/list', name: 'list_author')]
    public function list()
    {
        return $this->render('author/listA.html.twig', [
            'authors' => $this->authors,
        ]);
    }

    #[Route('/author/{id}', name: 'author_details')]
    public function authorDetails($id)
    {
        $author = null;
        // Parcourez le tableau pour trouver l'auteur correspondant à l'ID
        foreach ($this->authors as $authorData) {
            if ($authorData['id'] == $id) {
                $author = $authorData;
            };
        };
        return $this->render('author/showA.html.twig', [
            'author' => $author,
            'id' => $id
        ]);
    }

    #[Route('/listA',name: 'listAuteurs')]
    public function listAuteurs(AuthorRepository $repo){
       $list=$repo->findAll();
       return $this->render('author/list.html.twig',['authors'=>$list]);
    }
    #[Route('/show/{id}',name: 'showAut')]
    public function showAut($id,AuthorRepository $repo){
      $author=$repo->find($id);
      return $this->render('author/show.html.twig',['auteur'=>$author]);
    }
    #[Route('/deleteA/{id}',name:'deleleAuthor')]
    public function deleleAuthor($id,AuthorRepository $repo,ManagerRegistry $manager){
        $author=$repo->find($id);
        $em=$manager->getManager();
        $em->remove($author);
        $em->flush();
        return $this->redirectToRoute('listAuteurs');
    }
    #[Route('/addstatic', name: 'addStatic')]
    public function addStatic(ManagerRegistry $manager){
        $author=new Author();
        $author->setUsername('test');
        $author->setEmail('foulen@gmail.com');
        $em=$manager->getManager();
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute('listAuteurs');
    }

    #[Route('/add',name: 'add')]
    public function add(Request $request,ManagerRegistry $manager){
      $author=new Author();
      $form=$this->createForm(AuthorType::class,$author);
      $form->handleRequest($request);
     if ($form->isSubmitted()){
         $em=$manager->getManager();
         $em->persist($author);
         $em->flush();
         return $this->redirectToRoute('listAuteurs');

     }
      return $this->render('author/add.html.twig',['form'=>$form->createView()]);
      //renderForm(...)
    }
    #[Route('/update/{id}',name: 'updateAuth')]
    public function updateAuth($id,AuthorRepository $repo,Request $request,ManagerRegistry $manager){
         $author=$repo->find($id);
         $form=$this->createForm(AuthorType::class,$author);
         $form->handleRequest($request);
         if($form->isSubmitted()){
              $em=$manager->getManager();
              $em->persist($author);
              $em->flush();
             return $this->redirectToRoute('listAuteurs');
         }


         return $this->render('author/update.html.twig',['form'=>$form->createView()]);
    }

    //Query Builder: Question 1
    #[Route('/author/list/OrderByEmail', name: 'app_author_list_ordered', methods: ['GET'])]
    public function listAuthorByEmail(AuthorRepository $authorRepository): Response
    {
        return $this->render('author/orderedList.html.twig', [
            'authors' => $authorRepository->showAllAuthorsOrderByEmail(),
        ]);
    }

}
