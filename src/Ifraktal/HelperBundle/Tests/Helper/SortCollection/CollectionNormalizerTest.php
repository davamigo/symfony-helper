<?php

namespace Ifraktal\HelperBundle\Tests\Helper\SortCollection;

use Doctrine\Common\Collections\ArrayCollection;
use Ifraktal\HelperBundle\Helper\SortCollection\CollectionNormalizer;

/**
 * Class CollectionNormalizerTest
 *
 * @package Ifraktal\HelperBundle\Tests\Helper\SortCollection
 * @author David Amigo <davamigo@gmail.com>
 */
class CollectionNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Normalize ArrayCollection Return Valid Array
     */
    function testNormalizeArrayCollectionReturnValidArray()
    {
        $expected = array(
            'apple',
            'orange',
            'banana'
        );

        $source = new ArrayCollection($expected);

        $collectionNormalizer = new CollectionNormalizer();
        $result = $collectionNormalizer->normalizeCollection($source);

        $this->assertEquals($expected, $result);
    }

    /**
     * Normalize Array Return The Same Array
     */
    function testNormalizeArrayReturnTheSameArray()
    {
        $expected = array(
            'apple',
            'orange',
            'banana'
        );

        $source = $expected;

        $collectionNormalizer = new CollectionNormalizer();
        $result = $collectionNormalizer->normalizeCollection($source);

        $this->assertEquals($expected, $result);
    }

    /**
     * Normalize Null Return An Empty Array
     */
    function testNormalizeNullReturnAnEmptyArray()
    {
        $expected = array();
        $source = null;

        $collectionNormalizer = new CollectionNormalizer();
        $result = $collectionNormalizer->normalizeCollection($source);

        $this->assertEquals($expected, $result);
    }
}
