<?php

namespace App\Controller;

use App\Entity\Annonces;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoncesController extends AbstractController
{   
    /**
    * @Route("/", name="index")
    */
   
    public function index(ManagerRegistry $doctrine): Response
    {  
        
        $annonces =$doctrine->getRepository(Annonces:: class)->findAll();
        return $this->render('annonces/index.html.twig',[
            "annonces" => $annonces
        ]);
    }

    /**
     * @Route("/detail", name="detail")
     */
    public function detail(): Response
    {
        return $this->render('annonces/detail.html.twig');
    }

    /**
     * @Route("/add", name="annonce_add")
     */
    public function add(ManagerRegistry $doctrine)
    {   
        
        $entityManager = $doctrine->getManager();
        
        
        $annonces = new Annonces;
        $annonces-> setTitle('Back Pack');
        $annonces->setPrix('12');
        $annonces->setContent('branded backpack having good quality of zip and side pocket for water bottle!');
        $annonces->setCreatedat(new \DateTime());
        $annonces->setUpdatedat( new \DateTime());
        
       
        $entityManager->persist($annonces);
        
        $entityManager->flush();
        
        return new Response("<h1> Bravo les données sont a été ajouté !!</h1>");
        
        
    }

    /**
     * @Route("/delete/{id}", name="annonce_delete")
     */
    public function delete($id,ManagerRegistry $doctrine) 
    {
        
        $entityManager = $doctrine->getManager();
        
        $annonces = $doctrine->getRepository(Annonces::class)->find($id);

        $entityManager->remove($annonces);
       
        $entityManager->flush();

        return new Response("<h1>Bravo le donnée a été suprimé</h1>");
    }

    
    }