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
        return ['performers' => $performers];
    }

    /**
     * @Route("/performer/add", name="add_performer")
     * @param Request $request
     * @Method({"POST"})
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(PerformerType::class);
        $form->add('save', SubmitType::class, ['label' => 'Сохранить']);
        $form->add('canсel', SubmitType::class, [
                'label' => 'Отмена', 
                'attr' => [
                    'formnovalidate' => 'formnovalidate'
                ]
            ]
        );

        $form->handleRequest($request);
        
        if ($form->get('canсel')->isClicked()) {
            return $this->redirectToRoute('performer_index');
        }
        
        if ($form->isValid() && $form->get('save')->isClicked()) 
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
        $form->add('save', SubmitType::class, ['label' => 'Сохранить']);
        $form->add('canсel', SubmitType::class, [
                'label' => 'Отмена', 
                'attr' => [
                    'formnovalidate' => 'formnovalidate'
                ]
            ]
        );

        $form->handleRequest($request);
        
        if ($form->get('canсel')->isClicked()) {
            return $this->redirectToRoute('performer_index');
        }
        
        if ($form->isValid() && $form->get('save')->isClicked()) 
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
     * @Route("performer/remove/{id}", name="removePerformer", requirements={"id"="\d+"})
     * @Method({"GET"})
     */
    public function removeAction($id)
    {
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
