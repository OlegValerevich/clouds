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
use AppBundle\Entity\Task;
use AppBundle\Entity\Performer;

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
     * @Method({"GET"})
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
     * @Method({"POST"})
     */
    public function updateAction(Request $request)
    {
        if (!$request->request->get('performer')) {
            $rs['success'] = 0;
            $rs['massage']= 'Ошибка! Необходимы исполнители.';
            return new JsonResponse($rs, 200);
        }
        
        $task = new Task();
        $performerId = $request->request->get('performer');
        $performer = $this->getDoctrine()->getRepository('AppBundle:Performer')->find($performerId);
        $task->setPerformer($performer);
        
        $task->setName($request->request->get('name'));
        
        $task->setStatus($request->request->get('status'));
        
        $task->setDescription($request->request->get('description'));
              
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
             
        $rs['success'] = 1;
        $rs['massage']= 'Задание добавлено';
        
        return new JsonResponse($rs, 200);
    }
         
    /**
     * @Route("/task/add", name="add_task")
     * @Method({"POST"})
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
            $rs['massage']= 'Ошибка! Необходимы исполнители.';
        }
        return new JsonResponse($rs, 200);
    }
}