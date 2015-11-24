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

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Grade', $client->getResponse()->getContent());
    }

    public function testGradeAdd()
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



        $crawler = $client->request('POST', '/admin/grade/add');

        $form = $crawler->selectButton('Save')->form();

        $form['appbundle_grade[mark]'] = '-15';
        $form['appbundle_grade[student]'] = '';
        $form['appbundle_grade[exam]'] = '';

        $client->submit($form);

        $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('-15', $client->getResponse()->getContent());
    }

    public function testGradeDelete()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';



        $client->submit($form);

        $crawler = $client->request('GET', '/admin');

        $link = $crawler->filter('a.grade_delete')->first()->link();


        $client->click($link);



        $client->request('GET', '/admin/');


        $this->assertContains('Student', $client->getResponse()->getContent());
    }
}