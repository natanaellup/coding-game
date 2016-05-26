<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserListController extends Controller
{
    public function listAction(Request $request)
    {
        $userRepo = $this->getDoctrine()->getRepository('UserBundle:User');
        $users = $userRepo->findAll();
        dump($users);die;
    }
}