<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 20/11/2015
 * Time: 18:49
 */

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerTest extends WebTestCase
{
    public function testLoginAdmin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'adminuser';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testStudentList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/student');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Students list', $client->getResponse()->getContent());
    }

    public function testGradeList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/grade');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Grades list', $client->getResponse()->getContent());
    }

    public function testExamList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/exam');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Exams list', $client->getResponse()->getContent());
    }

}