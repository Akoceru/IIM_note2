<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 24/11/2015
 * Time: 14:26
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Exam;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadExamData extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {
        $date = new \DateTime("2012-07-08 11:14:15.638276");
        $exam = new Exam();
        $exam->setName('New super exam')
            ->setDescription('Check this out')
            ->setDate($date);


        // Je sauvegarde en DB
        $manager->persist($exam);
        $manager->flush();
    }

}