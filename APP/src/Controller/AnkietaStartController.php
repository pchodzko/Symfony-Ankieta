<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DobType;
use App\Form\NameType;
use App\Form\SurveyType;
use App\Entity\SurveyAnswer;

class AnkietaStartController extends Controller {

    /**
     * @Route("/", name="ankieta")
     */
    public function index(Request $request) {



        return $this->render('ankieta_start/index.html.twig', [

        ]);
    }

    /**
     * @Route("/ankieta/start", name="ankieta_start")
     */
    public function survey(Request $request) {
        $SurveyAnswer = new SurveyAnswer();
        $form = $this->createForm(SurveyType::class, $SurveyAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $surveyData = $form->getData();
            $surveyData->setUser($this->getUser());
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($surveyData);
            $entityManager->flush();
            $this->addFlash(
                    'notice', 'Dziękujemy za udział w ankiecie!'
            );
            return $this->redirectToRoute('ankieta');
        }

        return $this->render('ankieta_start/survey.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

}
