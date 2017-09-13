<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ReportController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        echo $_SERVER['REMOTE_ADDR'];
        exit;
    }
}
