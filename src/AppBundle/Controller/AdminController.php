<?php // src/AppBundle/AdminController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Admin;
use AppBundle\Form\AdminType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminController
 */
class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_list")
     */
    public function indexAction()
    {
        $admins = $this->getDoctrine()->getManager()->getRepository('AppBundle:Admin')->findAll();
        $students = $this->getDoctrine()->getManager()->getRepository('AppBundle:Student')->findAll();
        $exams = $this->getDoctrine()->getManager()->getRepository('AppBundle:Exam')->findAll();
        $grades = $this->getDoctrine()->getManager()->getRepository('AppBundle:Grade')->findAll();

        return $this->render('AppBundle:Admin:index.html.twig', [
            'admins' => $admins,
            'students' => $students,
            'exams' => $exams,
            'grades' => $grades,

        ]);
    }
    /**
     * @Route("/admin/admin", name="admin_add")
     */
    public function addAction(Request $request)
    {
        $admin = new Admin();
        $form = $this->createForm(new AdminType(),$admin);

        if($request->isMethod('POST')
            && $form->handleRequest($request)
            && $form->isValid()){

            $admin->setRoles(['ROLE_SUPER_ADMIN'])
                ->setEnabled(1);
            $this->get('fos_user.user_manager')->updateUser($admin);


            return $this->redirectToRoute('admin_list');
        }

        return $this->render('AppBundle:Admin:add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @route("/admin/admin/delete/{id}", name="admin_delete")
     */
    public function deleteAction($id)
    {
        $db = $this->getDoctrine()->getManager();

        $admin = $db
            ->getRepository('AppBundle:Admin')
            ->find($id);

        $db->remove($admin);
        $db->flush();

        return $this->redirectToRoute('admin_list');
    }


}
