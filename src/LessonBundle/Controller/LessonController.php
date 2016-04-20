<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/20/2016
 * Time: 2:01 PM
 */

namespace LessonBundle\Controller;


use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LessonController extends Controller
{


    public function viewAction($id)
    {
        $service = $this->get('lesson_bundle.lesson_service');
        $lesson = $service->getLessonById($id);
        return $this->render('LessonBundle:Lesson:show.html.twig', array('lesson' => $lesson));
    }

    public function postAnswerAction(Request $request){

        $option = $request->get('option');
        $questionId = $request->get('question_id');
        return new JsonResponse(array('option' => $option, 'question_id' => $questionId));
    }
}