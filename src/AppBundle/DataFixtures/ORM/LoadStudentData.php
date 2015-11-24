<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 24/11/2015
 * Time: 14:14
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Student;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStudentData extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {
        $student = new Student();
        $student->setEmail('test@test.com');
        $student->setFirstName('Jean');
        $student->setLastName('Dupont');

        // Je sauvegarde en DB
        $manager->persist($student);
        $manager->flush();
    }

}