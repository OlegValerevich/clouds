<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
//     /**
//      * @Route("/", name="homepage")
//      * @Template("@App/default/index.html.twig")
//      */
//     public function indexAction()
//     {
//         // $performers = $this->getDoctrine()->getRepository('AppBundle:Performer')->findAll();
// //         // $tasks = $this->getDoctrine()->getRepository('AppBundle:Task')->findAll();
//       $performers = [
//         'id' => 1,
//         'name' => 'Иванов Иван Иваныч',
//         'position' => 'директор'
//       ];

// //       $tasks = [
// //         'id' => 1,
// //         'name' => 'Task 1',
// //         'performerId' => 1,
// //         'status' => 1,
// //         'description' => 'Progect 3'
// //       ];
// //         dump($performers);
// //         dump($tasks);
// // //        return $this->render('@App/default/index.html.twig', ['performers' => $performers]);
// // //        return ['perfomers' => $performers];
//         return $this->render('@App/default/index.html.twig', [
//               'performers' => compact('performers')
//               ]);
//     }
       
//     /**
//      * @Route("/remove/{id}", name="remove")
//      */
//     public function removeAction($id)
//     {
//         $this
//                ->getDoctrine()
//                ->getRepository('AppBundle:Performer')
//                ->remove($id);
        
//        $rsData['success']=1;
       
//        echo json_encode($rsData);
//        return $this->redirectToRoute('homepage');
// //        return json_encode($rsData);
//     }
}
