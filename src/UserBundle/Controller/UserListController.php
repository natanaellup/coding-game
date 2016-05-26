<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class UserListController extends Controller
{
    public function listAction(Request $request)
    {
        $userRepo = $this->getDoctrine()->getRepository('UserBundle:User');
        $users = $userRepo->findAll();

        $xp = $this->calculateXp($users);
        $badges = $this->getBadges($users);

        return $this->render('UserBundle:List:list_users.html.twig',array('users' => $users, 'xp' => $xp, 'badges' => $badges));
    }

    public function showAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getManager()->getRepository('UserBundle:User')->find($id);
        $arrayWithUser[] = $user;
        $xp = $this->calculateXp($arrayWithUser);
        $badges = $this->getBadges($arrayWithUser);


    }

    protected function getBadges($users)
    {
        $badges = array();
        foreach($users as $user){
            $userBadges = $user->getBadges();

            foreach($userBadges as $badge){
                $tempArr['badge_language'] = $badge->getLanguage()->getName();
                $tempArr['badge_title'] = $badge->getTitle();
                $tempArr['badge_logo_url'] = $badge->getLogoUrl();
                $badges[$user->getId()][] = json_encode($tempArr);
            }
        }

        return $badges;
    }

    protected function calculateXp($users)
    {
        $xp = array();
        foreach ($users as $user) {
            $userId = $user->getId();
            $xp[$user->getId()] = array();
            $activityTracking = $this->get('activity_bundle.services.activity_tracking');
            foreach ($user->getActivities() as $activity) {
                $language = $activity->getLesson()->getLanguage();
                if (!array_key_exists($language->getName(), $xp[$user->getId()])) {
                    $xp[$userId][$language->getName()] = $activityTracking->getLanguageScore($language, $user);
                } else {
                    $xp[$userId][$language->getName()] += $activityTracking->getLanguageScore($language, $user);
                }
            }
        }

        return $xp;
    }
}