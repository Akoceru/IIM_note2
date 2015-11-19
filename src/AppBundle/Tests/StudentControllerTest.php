<?php

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/student');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Student', $client->getResponse()->getContent());
    }
}
