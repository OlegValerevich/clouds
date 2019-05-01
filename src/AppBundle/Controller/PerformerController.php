<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\PerformerType;
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
     * @param Request $request
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(PerformerType::class);
        $form->add('Save', SubmitType::class);
        $form->add('Cansel', SubmitType::class);

        $form->handleRequest($request);
        
        if ($form->isValid() && $form->isSubmitted()) 
        {
            $perfomer = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($perfomer);
            
            $em->flush();
             
            return $this->redirectToRoute('performer_index');
        }

        return $this->render('@App/performer/add.html.twig',[
            'add_form' => $form->createView()
        ]);
    }
    
     /**
     * @Route("/performer/edit/{id}", name="edit_performer", requirements={"id"="\d+"})
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {
        $performer = $this->getDoctrine()->getRepository('AppBundle:Performer')->find($id);

        if(!$performer){
            $this->addFlash('error', 'User does not exist');            
            return $this->redirectToRoute('performer_index');
        }
        
        $form = $this->createForm(PerformerType::class, $performer);
        $form->add('Save', SubmitType::class);
        $form->add('Cansel', SubmitType::class);
        
        $form->handleRequest($request);
        
        if ($form->isValid() && $form->isSubmitted()) 
        {
            $perfomer = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($perfomer);
            
            $em->flush();
             
            return $this->redirectToRoute('performer_index');
        }
        
        return $this->render('@App/performer/edit.html.twig',[
            'edit_form' => $form->createView()
        ]);
    }

    /**
     * @Route("performer/remove/{id}", name="removePerformer")
     */
    public function removeAction($id)
    {
        $id = intval($id);
        $performer = $this->getDoctrine()->getRepository('AppBundle:Performer')->find($id);
        
        if($performer){
            $id = $performer->getId();
            $this->getDoctrine()->getRepository('AppBundle:Performer')->remove($id);
            $rs['success'] = 1;
        }else{
            $rs['success'] = 0;
        }
        return new JsonResponse($rs, 200);
    }
}
