<?php

namespace ActivityBundle\Entity;

use LessonBundle\Entity\Lesson;
use UserBundle\Entity\User;

class UserActivity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $score;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Lesson
     */
    private $lesson;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param float $score
     * @return UserActivity
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return UserActivity
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Lesson
     */
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * @param Lesson $lesson
     * @return UserActivity
     */
    public function setLesson($lesson)
    {
        $this->lesson = $lesson;
        return $this;
    }

}