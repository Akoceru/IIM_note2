<?php // src/AppBundle/StudentController.php
namespace AppBundle\Controller;
use AppBundle\Entity\Student;
use AppBundle\Entity\Grade;
use AppBundle\Form\StudentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class StudentController
 */
class StudentController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
     public function homepage()
     {
       return $this->render('AppBundle:Homepage:index.html.twig');
     }

    /**
     * @Route("/student", name="student_list")
     */
    public function indexAction()
    {
        $students = $this->getDoctrine()->getManager()->getRepository('AppBundle:Student')->findAll();
        return $this->render('AppBundle:Student:index.html.twig', [
            'students' => $students
        ]);
    }
    /**
     * @Route("/student/details/{id}", name="student_details")
     */
    public function indexIdAction($id)
    {
        $students = $this->getDoctrine()->getManager()->getRepository('AppBundle:Student')->find($id);
        $grades = $students->getGrades();
        return $this->render('AppBundle:Student:single.html.twig', [
            'students' => $students,
            'grades' => $grades
        ]);
    }
    /**
     * @Route("/admin/student/add", name="student_add")
     */
    public function addAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(new StudentType(),$student);
        if($request->isMethod('POST') && $form->handleRequest($request) && $form->isValid()){
            $db = $this->getDoctrine()->getManager();
            $db->persist($student);
            $db->flush();
            return $this->redirectToRoute('student_list');
        }
        return $this->render('AppBundle:Student:add.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @route("/student/delete/{id}", name="student_delete")
     */
    public function deleteAction($id)
    {
        $db = $this->getDoctrine()->getManager();
        $student = $db
            ->getRepository('AppBundle:Student')
            ->find($id);
        $db->remove($student);
        $db->flush();
        return $this->redirectToRoute('admin_list');
    }
    /**
     * @route("/student/update/{id}", name="student_update")
     */
    public function updateAction($id)
    {
        $request = $this->get('request');
        if (is_null($id)) {
            $examData = $request->get('student');
            $id = $examData['id'];
        }
        $em = $this->getDoctrine()->getEntityManager();
        $student = $em->getRepository('AppBundle:Student')->find($id);
        $form = $this->createForm(new StudentType(), $student);
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return $this->redirect($this->generateUrl('admin_list'));
            }
        }
        return $this->render('AppBundle:Student:update.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
