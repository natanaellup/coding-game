<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/20/2016
 * Time: 2:01 PM
 */

namespace LessonBundle\Controller;


use ActivityBundle\Services\ActivityTracking;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use LessonBundle\Entity\Lesson;
use LessonBundle\Services\QuestionService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{


    public function viewAction($id)
    {
        $service = $this->get('lesson_bundle.lesson_service');
        $doctrine = $this->getDoctrine();
        /**
         * @var $lesson Lesson
         */
        $lesson = $service->getLessonById($id);
        $activityService = new ActivityTracking($doctrine, $this->get('security.token_storage'));
        if($activityService->getLanguageTotalScore($lesson->getLanguage()) < $lesson->getScoreToUnlock()){
            return new Response('You are not allowed to view this lesson. Please collect more than ' . $lesson->getScoreToUnlock() . ' experience points (xp) to access this lesson.');
        }
        return $this->render('LessonBundle:Lesson:show.html.twig', array('lesson' => $lesson, 'questionService' => new QuestionService($doctrine)));
    }

    public function postAnswerAction(Request $request)
    {
        $option = $request->get('option');
        $questionId = $request->get('question_id');
        $lessonsService = $this->get('lesson_bundle.lesson_service');
        $question = $lessonsService->saveQuestionResponse($questionId, $option);
        return new JsonResponse(
            array(
                'option' => $option,
                'question_id' => $questionId,
                'check' => (int)$lessonsService->questionIsCorrect($question, $option),
                'totalLessonScore' => $lessonsService->getLessonTotalScore($question->getLesson())
            ));
    }

}