<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 20/11/2015
 * Time: 18:49
 */

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExamControllerTest extends WebTestCase
{
    public function testExam()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Grade', $client->getResponse()->getContent());
    }

    public function testExamAdd()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Grade', $client->getResponse()->getContent());



        $crawler = $client->request('POST', '/admin/exam/add');
        $form = $crawler->selectButton('Save')->form();

        $form['appbundle_exam[name]'] = 'my new exam';
        $form['appbundle_exam[description]'] = 'new exam';


        $client->submit($form);

        $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('my new exam', $client->getResponse()->getContent());
    }

    public function testExamDelete()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $link = $crawler->filter('a.exam_delete')->first()->link();


        $client->click($link);


        $client->request('GET', '/admin');


        $this->assertContains('Student', $client->getResponse()->getContent());
    }
}