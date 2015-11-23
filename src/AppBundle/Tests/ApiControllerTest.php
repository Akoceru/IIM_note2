<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 23/11/2015
 * Time: 15:01
 */

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ApiControllerTest extends WebTestCase
{
    public function testApiStudentList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/students');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('[', $client->getResponse()->getContent());
    }

    public function testApiGradeList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/grade');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('[', $client->getResponse()->getContent());
    }

    public function testApiExamList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/exam');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('[', $client->getResponse()->getContent());
    }
}