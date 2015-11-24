<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 24/11/2015
 * Time: 14:26
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Grade;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadGradeData extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {

        $grade = new Grade();
        $grade->setMark(15);


        // Je sauvegarde en DB
        $manager->persist($grade);
        $manager->flush();
    }

}