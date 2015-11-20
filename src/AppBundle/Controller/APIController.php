<?php


namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



/**
 * Class APIController
 */
class APIController extends FOSRestController
{
    public function getStudentsAction()
    {

        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Student')
            ->findAll(); // get data, in this case list of users.

        $view = $this->view($data, 200)
        ;

        return $this->handleView($view);
    }

    public function getGradesAction($id)
    {

        $students = $this->getDoctrine()->getManager()->getRepository('AppBundle:Student')->find($id);
        $grades = $students->getGrades();
        $view = $this->view($grades, 200)
        ;

        return $this->handleView($view);
    }

    public function getExamAction()
    {

        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Exam')
            ->findAll(); // get data, in this case list of users.

        $view = $this->view($data, 200)
        ;

        return $this->handleView($view);
    }
    
    public function getGradeAction()
    {

        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Grade')
            ->findAll(); // get data, in this case list of users.

        $view = $this->view($data, 200)
        ;

        return $this->handleView($view);
    }

}