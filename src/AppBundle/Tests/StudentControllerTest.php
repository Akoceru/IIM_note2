<?php

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentControllerTest extends WebTestCase
{
    public function testStudent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'adminuser';
        $form['_password'] = 'admin';

        $client->submit($form);

        $crawler = $client->request('GET', '/admin/student');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Student', $client->getResponse()->getContent());
    }

    public function testStudentAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'adminuser';
        $form['_password'] = 'admin';

        $client->submit($form);

        $crawler = $client->request('POST', '/admin/student/add');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Student', $client->getResponse()->getContent());
    }
}
