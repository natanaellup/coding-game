<?php

namespace ActivityBundle\Repository;

use Doctrine\ORM\EntityRepository;
use LessonBundle\Entity\Language;
use UserBundle\Entity\User;

class UserActivityRepository extends EntityRepository
{
    public function getCountLessonFinished(Language $language, User $user)
    {
        $qb = $this->createQueryBuilder('userActivity')
                    ->select('count(userActivity)')
                    ->innerJoin('userActivity.lesson','lesson')
                    ->where('lesson.language = :language AND userActivity.user = :user');

        $qb->setParameters(array('language' => $language, 'user' => $user));

        return $qb->getQuery()->getResult()[0][1];
    }
}