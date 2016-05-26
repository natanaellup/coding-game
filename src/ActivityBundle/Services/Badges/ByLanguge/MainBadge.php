<?php

namespace ActivityBundle\Services\Badges\ByLanguage;

use Doctrine\Bundle\DoctrineBundle\Registry;
use LessonBundle\Entity\Language;

/**
 * Date: 5/26/2016
 * Time: 19:00
 * @copyright (c) Zitec COM
 * @author George Calcea <george.calcea@zitec.com>
 */
class MainBadge
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
     * @var Language
     */
    private $language;

    /**
     * ActivityTracking constructor.
     *
     * @param Registry $doctrine
     * @param TokenStorage $securityContext
     */
    public function __construct(Registry $doctrine, TokenStorage $securityContext, Language $language)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->user = $securityContext->getToken()->getUser();
        $this->language = $language;
    }

}