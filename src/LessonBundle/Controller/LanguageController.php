<?php
namespace LessonBundle\Controller;

use ActivityBundle\Services\ActivityTracking;
use Doctrine\ORM\EntityRepository;
use LessonBundle\Entity\Language;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends Controller
{

    public function showAllAction(Request $request)
    {
        /** @var EntityRepository $languageRepo */
        $languageRepo = $this->getDoctrine()->getManager()->getRepository('LessonBundle:Language');

        $languages = $languageRepo->findAll();
        $scores = $this->mappedScoreForLanguage($languages);

        return $this->render('LessonBundle:Language:show_all.html.twig',array( 'scores'=> $scores,'languages' => $languages));
    }

    public function showAction(Request $request, $id)
    {
        /** @var EntityRepository $languageRepo */
        $languageRepo = $this->getDoctrine()->getManager()->getRepository('LessonBundle:Language');

        $language = $languageRepo->find($id);
        return $this->render('LessonBundle:Language:show.html.twig', array('language' => $language, 'activityTracking' => new ActivityTracking($this->getDoctrine(), $this->get('security.token_storage') )));
    }

    /**
     * @param array $languages
     *
     * @return array
     */
    private function mappedScoreForLanguage($languages)
    {
        $activityService = $this->get('activity_bundle.services.activity_tracking');
        $languageScores = array();
        /** @var Language $language */
        foreach($languages as $language)
        {
            $languageScores[$language->getId()] = $activityService->getLanguagePercentage($language);
        }

        return $languageScores;
    }
}