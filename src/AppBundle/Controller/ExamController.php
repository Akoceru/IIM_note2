<?php // src/AppBundle/ExamController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Exam;
use AppBundle\Form\ExamType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ExamController
 */
class ExamController extends Controller
{
    /**
     * @Route("/exam", name="exam_list")
     */
    public function indexAction()
    {
        $exams = $this->getDoctrine()->getManager()->getRepository('AppBundle:Exam')->findAll();

        return $this->render('AppBundle:Exam:index.html.twig', [
            'exams' => $exams
        ]);
    }

    /**
     * @Route("/admin/exam/add", name="exam_add")
     */
    public function addAction(Request $request)
    {
        $exam = new Exam();
        $form = $this->createForm(new ExamType(),$exam);

        if($request->isMethod('POST') && $form->handleRequest($request) && $form->isValid()){
            $db = $this->getDoctrine()->getManager();
            $db->persist($exam);
            $db->flush();

            return $this->redirectToRoute('admin_list');
        }

        return $this->render('AppBundle:Exam:add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @route("/exam/delete/{id}", name="exam_delete")
     */
    public function deleteAction($id)
    {
        $db = $this->getDoctrine()->getManager();

        $student = $db
            ->getRepository('AppBundle:Exam')
            ->find($id);

        $db->remove($student);
        $db->flush();

        return $this->redirectToRoute('admin_list');
    }

    /**
     * @route("/exam/update/{id}", name="exam_update")
     */

    public function updateAction($id)
    {
        $request = $this->get('request');

        if (is_null($id)) {
            $examData = $request->get('exam');
            $id = $examData['id'];
        }

        $em = $this->getDoctrine()->getEntityManager();
        $exam = $em->getRepository('AppBundle:Exam')->find($id);
        $form = $this->createForm(new ExamType(), $exam);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $em->flush();

                return $this->redirect($this->generateUrl('admin_list'));
            }
        }

        return $this->render('AppBundle:Exam:update.html.twig', array(
            'form' => $form->createView()
        ));
    }
}