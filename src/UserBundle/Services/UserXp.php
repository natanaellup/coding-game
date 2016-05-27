<?php

use Doctrine\Bundle\DoctrineBundle\Registry;
use ActivityBundle\Services\ActivityTracking;

class UserXp
{
    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * @var ActivityTracking
     */
    protected $activityTracking;

    /**
     * UserXp constructor.
     * @param $doctrine
     * @param $activityTracking
     */
    public function __construct($doctrine, $activityTracking)
    {
        $this->doctrine = $doctrine;
        $this->activityTracking = $activityTracking;
    }

    /**
     * @param $user
     */
    public function getXpForAnUser($user)
    {

    }
}