<?php
namespace ActivityBundle\Services;

use ActivityBundle\Entity\UserActivity;
use Doctrine\Bundle\DoctrineBundle\Registry;
use LessonBundle\Entity\Language;
use LessonBundle\Entity\Lesson;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use UserBundle\Entity\User;

class ActivityTracking
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var TokenStorage
     */
    private $securityContext;

    /**
     * @var User
     */
    private $user;

    /**
     * ActivityTracking constructor.
     *
     * @param Registry $doctrine
     * @param TokenStorage $securityContext
     */
    public function __construct(Registry $doctrine, TokenStorage $securityContext)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->user = $securityContext->getToken()->getUser();
    }

    /**
     * Return score for an exam for current user.
     *
     * @param Lesson $lesson
     * @return float
     */
    public function getExamScore(Lesson $lesson)
    {
        $activityRepo = $this->doctrine->getManager()->getRepository('ActivityBundle:UserActivity');
        /** @var UserActivity $activity */
        $activity = $activityRepo->findBy(array('user' => $this->user, 'lesson' => $lesson));

        return $activity->getScore();
    }

    /**
     * @param Language $language
     *
     * @return float
     */
    public function getLanguagePercentage(Language $language)
    {
        $lessonRepo = $this->doctrine->getManager()->getRepository('LessonBundle:Lesson');
        $numberOfLessons = $lessonRepo->getCountLessons($language);

        $userActivityRepo = $this->doctrine->getManager()->getRepository('ActivityBundle:UserActivity');
        $numberOfFinishedLessons = $userActivityRepo->getCountLessonFinished($language,$this->user);

        if(empty($numberOfFinishedLessons) || empty($numberOfLessons) ){
            return 0;
        }

        return  floatval($numberOfFinishedLessons/$numberOfLessons * 100);
    }
}