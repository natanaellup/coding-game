<?php

namespace LessonBundle\Services;

use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/20/2016
 * Time: 2:32 PM
 */
class LessonService
{

    private $doctrineManager = null;
    private $lessonRepository = null;

    /**
     * LessonService constructor.
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrineManager = $doctrine;
        $this->lessonRepository = $doctrine->getRepository('LessonBundle:Lesson');
    }

    /**
     * @param $id
     * @return \LessonBundle\Entity\Lesson|object
     */
    public function getLessonById($id)
    {
        return $this->lessonRepository->find($id);
    }

}