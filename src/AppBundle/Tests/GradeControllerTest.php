<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 20/11/2015
 * Time: 18:49
 */

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GradeControllerTest extends WebTestCase
{
    public function testGrade()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'adminuser';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Grade', $client->getResponse()->getContent());
    }

    public function gradeStudentAdd()
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



        $crawler = $client->request('POST', '/admin/grade/add');

        $form = $crawler->selectButton('save')->form();

        $form['appbundle_student[email]'] = 'John@doe.com';
        $form['appbundle_student[firstName]'] = 'John';
        $form['appbundle_student[lastName]'] = 'Doe';

        $client->submit($form);

        $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('John - Doe', $client->getResponse()->getContent());
    }

    public function gradeStudentDelete()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'adminuser';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('POST', '/admin/student/add');

        $form = $crawler->selectButton('save')->form();

        $form['appbundle_student[email]'] = 'John@doe.com';
        $form['appbundle_student[firstName]'] = 'lel';
        $form['appbundle_student[lastName]'] = 'leel';

        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $link = $crawler->selectLink('delete')->link();


        $client->click($link);



        $client->request('GET', '/admin/student');


        $this->assertContains('Student', $client->getResponse()->getContent());
    }
}