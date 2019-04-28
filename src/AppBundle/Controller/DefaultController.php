<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("@App/default/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $performers = $this->getDoctrine()->getRepository('AppBundle:Performer')->findAll();
        $tasks = $this->getDoctrine()->getRepository('AppBundle:Task')->findAll();
        dump($performers);
        dump($tasks);
//        return $this->render('@App/default/index.html.twig', ['performers' => $performers]);
//        return ['perfomers' => $performers];
        return [
              'performers' => $performers,
              'tasks' => $tasks];
    }
}
