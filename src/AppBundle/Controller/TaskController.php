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
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Task;

/**
 * Description of TaskController
 * @Template("@App/task/index.html.twig")
 */
class TaskController extends Controller{

     /**
     * @Route("/task", name="task_index")
     */
    public function indexAction()
    {
        $tasks = $this->getDoctrine()->getRepository('AppBundle:Task')->findAll();

//        $tasks = [
//            'id' => 1,
//            'name' => 'Task 1',
//            'performerId' => 1,
//            'status' => 1,
//            'description' => 'Progect 3'
//        ];

        return ['tasks' => $tasks];
        
//        return $this->render('@App/task/index.html.twig', [
//              'tasks' => compact('tasks')
//          	]);
    }
      
    /**
     * @Route("/task/remove/{id}", name="removeTask")
     */
    public function removeAction($id)
    {
        $id = intval($id);
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
}
