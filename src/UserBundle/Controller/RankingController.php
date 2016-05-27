<?php
/**
 * Created by PhpStorm.
 * User: Naty
 * Date: 5/27/2016
 * Time: 6:57 PM
 */

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RankingController extends Controller
{
    /**
     * Show ranking.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showRankingAction(Request $request)
    {
        $userXpServices = $this->get('userbundle.user_experience');

        $users = $this->getDoctrine()->getRepository('UserBundle:User')->findAll();

        foreach($users as $user)
        {
            $xpUsers[$user->getId()] = $userXpServices->getXpForAnUser($user);
        }

        return $this->render('UserBundle:Ranking:show.html.twig', array('xp' => $xpUsers, 'users' =>$users));
    }
}