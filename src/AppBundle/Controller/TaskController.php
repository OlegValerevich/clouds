<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TaskType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\Query;

/**
 * Description of TaskController
 * 
 */
class TaskController extends Controller{

     /**
     * @Route("/task", name="task_index")
     * @Template("@App/task/index.html.twig")
     */
    public function indexAction()
    {
        $tasks = $this->getDoctrine()->getRepository('AppBundle:Task')->findAll();
        return ['tasks' => $tasks];
    }
      
    /**
     * @Route("/task/remove/{id}", name="removeTask", requirements={"id"="\d+"})
     */
    public function removeAction($id)
    {
        $task = $this->getDoctrine()->getRepository('AppBundle:Task')->find($id);
        
        if($task){
            $id = $task->getId();
            $this->getDoctrine()->getRepository('AppBundle:Task')->remove($id);
            $rs['success'] = 1;
        }else{
            $rs['success'] = 0;
        }
        return new JsonResponse($rs, 200);
    }
    
    /**
     * @Route("/task/edit/{id}", name="edit_task", requirements={"id"="\d+"})
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {
        $task = $this->getDoctrine()->getRepository('AppBundle:Task')->find($id);
        
        if(!$task){
            $this->addFlash('error', 'Task does not exist');            
            return $this->redirectToRoute('task_index');
        }
               
        $form = $this->createForm(TaskType::class, $task);
        $form->add('Save', SubmitType::class);
        $form->add('Cansel', SubmitType::class);
        
        $form->handleRequest($request);
        
        if ($form->isValid() && $form->isSubmitted()) 
        {
            $task = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
             
            return $this->redirectToRoute('task_index');
        }
        
        return $this->render('@App/task/edit.html.twig',[
            'edit_form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/task/update", name="update_task")
     * @param Request $request
     */
    public function updateAction(Request $request)
    {
        $form = $this->createForm(TaskType::class);
        $form->add('Save', SubmitType::class);
        $form->add('Cansel', SubmitType::class);

        $form->handleRequest($request);
        
        if ($form->isValid() && $form->isSubmitted()) 
        {
            $perfomer = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($perfomer);
            $em->flush();
             
            return $this->redirectToRoute('task_index');
        }

        return $this->render('@App/task/addModal.html.twig',[
            'add_form' => $form->createView()
        ]);
    }
         
    /**
     * @Route("/task/add", name="add_task")
     */
    public function addAction()
    {   
        $rs = [];
        $performer = [];
    
        $performers = $this->getDoctrine()->getRepository('AppBundle:Performer')->getPerformers();

        if($performers){
            foreach ($performers as $values){
                $values = array_values($values);
                $performer[$values[0]] = $values[1];
            }
            $rs['performers'] = $performer;
            $rs['success'] = 1;
        }else{
            $rs['success'] = 0;
        }
        return new JsonResponse($rs, 200);
    }
}
