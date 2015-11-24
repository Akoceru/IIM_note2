<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 24/11/2015
 * Time: 14:16
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Admin;
use AppBundle\Entity\Student;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class LoadAdminData
 */
class LoadAdminData extends AbstractFixture implements ContainerAwareInterface

{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setRoles(['ROLE_SUPER_ADMIN'])
            ->setEnabled(1)
            ->setEmail('admin@admin.com')
            ->setUsername('admin')
            ->setUsernameCanonical('admin')
            ->setPlainPassword('admin')
            ->setEmailCanonical('admin@admin.com');
        $this->container->get('fos_user.user_manager')->updateUser($admin);

    }
}