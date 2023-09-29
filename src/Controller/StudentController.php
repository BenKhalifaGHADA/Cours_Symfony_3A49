<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/test/{id}',name:'app_test')]
        public function test($id){
        return new Response("Hello 3A".$id);
    }
    #[Route('/home',name:'app_home')]
    public function home(){
        return $this->redirectToRoute('app_student');
    }


}
