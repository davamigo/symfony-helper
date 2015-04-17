<?php

namespace Ifraktal\HelperBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DefaultControllerTest
 *
 * @package Ifraktal\HelperBundle\Tests\Controller
 * @author David Amigo <davamigo@gmail.com>
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ifraktal/helper/examples');

        $this->assertTrue($crawler->filter('html:contains("Sort collection")')->count() > 0);
    }
}
