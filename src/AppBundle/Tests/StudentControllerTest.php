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

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';

        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Student', $client->getResponse()->getContent());
    }

    public function testStudentAdd()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Student', $client->getResponse()->getContent());



        $crawler = $client->request('POST', '/admin/student/add');

        $form = $crawler->selectButton('Save')->form();

        $form['appbundle_student[email]'] = 'John@doe.com';
        $form['appbundle_student[firstName]'] = 'John';
        $form['appbundle_student[lastName]'] = 'Doe';

        $client->submit($form);

        $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('John@doe', $client->getResponse()->getContent());
    }

    public function testStudentDelete()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);


        $crawler = $client->request('GET', '/admin');


        $link = $crawler->filter('a.student_delete')->first()->link();


        $client->click($link);


        $client->request('GET', '/admin');


        $this->assertContains('Student', $client->getResponse()->getContent());
    }
}
