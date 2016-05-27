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
        foreach ($xp as $userId => $xpUser) {
         $encodeXp[$userId] = json_encode($xpUser);
        }
        $badges = $this->getBadges($users);

        return $this->render('UserBundle:List:list_users.html.twig', array('users' => $users, 'xp' => $encodeXp, 'badges' => $badges));
    }

    public function showAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getManager()->getRepository('UserBundle:User')->find($id);
        $arrayWithUser[] = $user;
        $xp = $this->calculateXp($arrayWithUser);

        return $this->render('UserBundle:List:show_user.html.twig', array('user' => $user, 'xp' => $xp[$user->getId()]));
    }


    protected function getBadges($users)
    {
        $badges = array();
        foreach ($users as $user) {
            $userBadges = $user->getBadges();
            $badgesTemp = array();
            foreach ($userBadges as $badge) {
                $tempArr['badge_language'] = $badge->getLanguage()->getName();
                $tempArr['badge_title'] = $badge->getTitle();
                $tempArr['badge_logo_url'] = $badge->getLogoUrl();
                $badgesTemp[] = $tempArr;
            }

            $badges[$user->getId()] = json_encode($badgesTemp);
        }

        return $badges;
    }

    /**
     * Calculate user experience for each language.
     *
     * @param $users
     * @return array
     */
    protected function calculateXp($users)
    {
        $xp = array();
        $languages = $this->getDoctrine()->getManager()->getRepository('LessonBundle:Language')->findAll();

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

            foreach ($languages as $language) {
                if (!array_key_exists($language->getName(), $xp[$user->getId()])) {
                    $xp[$userId][$language->getName()] = 0;
                }
            }
        }

        return $xp;
    }
}