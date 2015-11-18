<?php


namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



/**
 * Class APIController
 */
class APIController extends FOSRestController
{

    /**
     * @Route("/students", name="api_students")
     */
    public function getStudentsAction()
    {

        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Student')
            ->findAll(); // get data, in this case list of users.

        $view = $this->view($data, 200)
        ;

        return $this->handleView($view);
    }

    /**
     * @Route("/exam", name="api_exam")
     */
    public function getExamAction()
    {

        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Exam')
            ->findAll(); // get data, in this case list of users.

        $view = $this->view($data, 200)
        ;

        return $this->handleView($view);
    }

    /**
     * @Route("/grade", name="api_grade")
     */
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