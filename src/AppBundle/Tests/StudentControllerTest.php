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

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Student', $client->getResponse()->getContent());



        $crawler = $client->request('POST', '/admin/student/add');

        $form = $crawler->selectButton('save')->form();

        $form['appbundle_student[email]'] = 'John@doe.com';
        $form['appbundle_student[firstName]'] = 'John';
        $form['appbundle_student[lastName]'] = 'Doe';

        $client->submit($form);

        $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Doe - John', $client->getResponse()->getContent());
    }

    public function testStudentDelete()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'adminuser';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin/student');




        $link = $crawler->selectLink('delete')->link();

        var_dump($link);

            $client->click($link);



        $client->request('GET', '/admin/student');


        $this->assertContains('Student', $client->getResponse()->getContent());
    }
}
