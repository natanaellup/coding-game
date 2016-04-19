<?php
namespace LessonBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends Controller
{

    public function showAllAction(Request $request)
    {
        /** @var EntityRepository $languageRepo */
        $languageRepo = $this->getDoctrine()->getManager()->getRepository('LessonBundle:Language');

        $languages = $languageRepo->findAll();

        return $this->render('LessonBundle:Language:show_all.html.twig',array('languages' => $languages));
    }

    public function showAction(Request $request, $id)
    {
        /** @var EntityRepository $languageRepo */
        $languageRepo = $this->getDoctrine()->getManager()->getRepository('LessonBundle:Language');

        $language = $languageRepo->find($id);

        return $this->render('LessonBundle:Language:show.html.twig', array('language' => $language));
    }
}