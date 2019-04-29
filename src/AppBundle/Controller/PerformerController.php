<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\AddPerformerType;
use AppBundle\Entity\Performer;

/**
 * Description of PerformerController
 *
 */
class PerformerController extends Controller{
    
    /**
     * @Route("/", name="performer_index")
     * @Template("@App/performer/index.html.twig")
     */
    public function indexAction()
    {
        $performers = $this->getDoctrine()->getRepository('AppBundle:Performer')->findAll();
        
//      $performers = [
//        'id' => 1,
//        'name' => 'Иванов Иван Иваныч',
//        'position' => 'директор'
//      ];

        return ['performers' => $performers];
        
//        return $this->render('@App/performer/index.html.twig', [
//              'performers' => compact('performers')
//            ]);
    }

    /**
     * @Route("/performer/add", name="add_performer")
     */
    public function addAction(Performer $performer)
    {
        $form = $this->createForm(
            AddPerformerType::class
        );

        dump($performer);
        die();
        // $form->handleRequest($performer);
        
        if ($form->isValid() && $form->isSubmitted()) 
        {
            
            return $this->redirectToRoute('performer_index');
        }

        return $this->render('@App/performer/add.html.twig',[
            'add_form' => $form->createView()
        ]);
    }
    

    public function aditAction(Performer $id)
    {
        return $this->render('@App/performer/adit.html.twig');
    }

    /**
     * @Route("performer/remove/{id}", name="remove")
     */
    public function removeAction(Performer $id)
    {
        $this
            ->getDoctrine()
            ->getRepository('AppBundle:Performer')
            ->remove($id);
       
       return $this->redirectToRoute('performer_index');
    }
}
