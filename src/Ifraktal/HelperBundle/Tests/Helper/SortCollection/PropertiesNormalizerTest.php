<?php

namespace Ifraktal\HelperBundle\Tests\Helper\SortCollection;

use Doctrine\Common\Collections\ArrayCollection;
use Ifraktal\HelperBundle\Helper\SortCollection\PropertiesNormalizer;

/**
 * Class PropertiesNormalizerTest
 *
 * @package Ifraktal\HelperBundle\Tests\Helper\SortCollection
 * @author David Amigo <davamigo@gmail.com>
 */
class PropertiesNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Normalize Array Return The Same Array
     */
    public function testNormalizeArrayReturnTheSameArray()
    {
        $expected = array(
            'apple',
            'orange',
            'banana'
        );

        $source = $expected;

        $propertiesNormalizer = new PropertiesNormalizer();
        $result = $propertiesNormalizer->normalizeProperties($source);

        $this->assertEquals($expected, $result);
    }

    /**
     * Normalize String Return Valid Array
     */
    public function testNormalizeStringReturnValidArray()
    {
        $expected = array(
            'orange'
        );

        $source = 'orange';

        $propertiesNormalizer = new PropertiesNormalizer();
        $result = $propertiesNormalizer->normalizeProperties($source);

        $this->assertEquals($expected, $result);
    }

    /**
     * Normalize Null Return An Empty Array
     */
    public function testNormalizeNullReturnAnEmptyArray()
    {
        $expected = array();
        $source = null;

        $propertiesNormalizer = new PropertiesNormalizer();
        $result = $propertiesNormalizer->normalizeProperties($source);

        $this->assertEquals($expected, $result);
    }

    /**
     * GetPropertyComponents Of String Without Dots Return Valid Array
     */
    public function testGetPropertyComponentsOfStringWithoutDotsReturnValidArray()
    {
        $expected = array(
            'banana'
        );

        $source = 'banana';

        $propertiesNormalizer = new PropertiesNormalizer();
        $result = $propertiesNormalizer->getPropertyComponents($source);

        $this->assertEquals($expected, $result);
    }

    /**
     * GetPropertyComponents Of String With Dots Return Valid Array
     */
    public function testGetPropertyComponentsOfStringWithDotsReturnValidArray()
    {
        $expected = array(
            'banana',
            'apple',
            'orange'
        );

        $source = 'banana.apple.orange';

        $propertiesNormalizer = new PropertiesNormalizer();
        $result = $propertiesNormalizer->getPropertyComponents($source);

        $this->assertEquals($expected, $result);
    }

    /**
     * GetPropertyComponents Of Array Return The Same Array
     */
    public function testGetPropertyComponentsOfArrayReturnTheSameArray()
    {
        $expected = array(
            'banana',
            'apple',
            'orange'
        );

        $source = $expected;

        $propertiesNormalizer = new PropertiesNormalizer();
        $result = $propertiesNormalizer->getPropertyComponents($source);

        $this->assertEquals($expected, $result);
    }
    /**
     * GetPropertyComponents Of Null Return An Empty Array
     */
    public function testGetPropertyComponentsOfNullReturnAnEmptyArray()
    {
        $expected = array();

        $source = null;

        $propertiesNormalizer = new PropertiesNormalizer();
        $result = $propertiesNormalizer->getPropertyComponents($source);

        $this->assertEquals($expected, $result);
    }
}
