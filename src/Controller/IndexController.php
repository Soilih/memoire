<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Domaine;
use App\Entity\Data;
use App\Entity\document;
use App\Entity\User;
use App\Form\DomaineType;
use App\Repository\DocumentRepository;
use App\Repository\DataRepository;
use App\Repository\DomaineRepository;
use App\Repository\UserRepository;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="app_index")
     */
    public function index( DomaineRepository $domaineRepository , 
    DocumentRepository $documentRepository , UserRepository  $userRepository , 
    DataRepository $dataRepository 
     
    ): Response
    {    
       $repo =  $domaineRepository->findAll();
       $docRepo = $documentRepository->findAll();
       $userRepo = $userRepository->findAll();
       $dataRepo  = $dataRepository->findAll();
         return $this->render('index/index.html.twig', [
           
             "nombredomaine" =>$repo , 
             "documents" =>$docRepo ,
             "nUser"=>$userRepo ,
             "dataRep"=> $dataRepo
           
        ]);
    }
   /**
     * @Route("/secure", name="secure_area")
     *
     * @throws \Exception
     */
    public function indexAction()
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_index');
        }

        if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('user_Accueil');
        }
        throw new \Exception(AccessDeniedException::class);
    }
    
    /**
     * @Route("/Accueil" , name= "user_Accueil" )
     *
     * @return void
     */
    public function accueilUser(DomaineRepository $domaineRepository , 
    DocumentRepository $documentRepository , UserRepository  $userRepository):Response
    {
        $repo =  $domaineRepository->findAll();
        $docRepo = $documentRepository->findAll();
        $userRepo = $userRepository->findAll();
      
         return $this->render('index/user.html.twig', [
            "nombredomaine" =>$repo , 
            "documents" =>$docRepo ,
            "nUser"=>$userRepo        
        ]);
    }

  

}
