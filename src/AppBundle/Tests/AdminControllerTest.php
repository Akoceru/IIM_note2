<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 20/11/2015
 * Time: 18:49
 */

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testAdmin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Admin', $client->getResponse()->getContent());
    }

    public function testAdminAdd()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');


        $crawler = $client->request('POST', '/admin/admin');
        $form = $crawler->selectButton('Save')->form();

        $form['appbundle_admin[username]'] = 'admin2';
        $form['appbundle_admin[PlainPassword]'] = 'admin2';
        $form['appbundle_admin[email]'] = 'admin2@admin.com';


        $client->submit($form);

        $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('admin2', $client->getResponse()->getContent());
    }

    public function testAdminDelete()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $link = $crawler->filter('a.admin_delete')->eq(1)->link();


        $client->click($link);


        $client->request('GET', '/admin');


        $this->assertContains('Admin', $client->getResponse()->getContent());
    }
}