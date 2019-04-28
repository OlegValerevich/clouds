<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PerformerController
 *
 */
class PerformerController extends Controller{
    
    /**
     * @Route("/performer", name="add_performer")
     */
    public function addAction(Request $request)
    {
        return $this->render('@App/performer/add.html.twig');
    }
    

    public function aditAction(Request $request)
    {
        return $this->render('@App/performer/adit.html.twig');
    }
}
