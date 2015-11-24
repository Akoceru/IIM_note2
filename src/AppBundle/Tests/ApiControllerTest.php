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
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }

    public function testApiGradeList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/grade');
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }

    public function testApiExamList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/exam');
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }
}