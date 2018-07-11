<?php

namespace App\Controller;

use App\Entity\SurveyAnswer;
use App\Form\SurveyAnswerType;
use App\Repository\SurveyAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @Route("/survey/answer")
 */
class SurveyAnswerController extends Controller
{
    /**
     * @Route("/", name="survey_answer_index", methods="GET")
     */
    public function index(SurveyAnswerRepository $surveyAnswerRepository): Response
    {
        return $this->render('survey_answer/index.html.twig', ['survey_answers' => $surveyAnswerRepository->findAll()]);
    }

    /**
     * @Route("/get/{_sort}/{_by}/{page}",
     *     defaults={
     *         "_sort": "ASC",
     *         "_by": "name",
     *         "page": "0"
     *     },
     *     requirements={
     *         "_sort": "ASC|DESC",
     *         "_by": "date|name",
     *         "page": "\d+"
     *     }, name="survey_answer_index_list", methods="GET")
     */
    public function getAnswers(SurveyAnswerRepository $surveyAnswerRepository,$_sort,$_by,$page): Response
    {
        $answer=$surveyAnswerRepository->findSortedBy($_sort,$_by,$page);
        $paginator = new Paginator($answer, $fetchJoinCollection = true);
dump(count($paginator));
        return $this->render('survey_answer/answers.html.twig', ['survey_answers' => $paginator,'count'=>count($paginator)]);
    }
    /**
     * @Route("/new", name="survey_answer_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $surveyAnswer = new SurveyAnswer();
        $form = $this->createForm(SurveyAnswerType::class, $surveyAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($surveyAnswer);
            $em->flush();

            return $this->redirectToRoute('survey_answer_index');
        }

        return $this->render('survey_answer/new.html.twig', [
            'survey_answer' => $surveyAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="survey_answer_show", methods="GET")
     */
    public function show(SurveyAnswer $surveyAnswer): Response
    {
        return $this->render('survey_answer/show.html.twig', ['survey_answer' => $surveyAnswer]);
    }

    /**
     * @Route("/{id}/edit", name="survey_answer_edit", methods="GET|POST")
     */
    public function edit(Request $request, SurveyAnswer $surveyAnswer): Response
    {
        $form = $this->createForm(SurveyAnswerType::class, $surveyAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('survey_answer_edit', ['id' => $surveyAnswer->getId()]);
        }

        return $this->render('survey_answer/edit.html.twig', [
            'survey_answer' => $surveyAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="survey_answer_delete", methods="DELETE")
     */
    public function delete(Request $request, SurveyAnswer $surveyAnswer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$surveyAnswer->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($surveyAnswer);
            $em->flush();
        }

        return $this->redirectToRoute('survey_answer_index');
    }
}
