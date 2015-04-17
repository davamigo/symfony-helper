<?php

namespace Ifraktal\HelperBundle\Tests\Helper\SortCollection;

use Ifraktal\HelperBundle\Helper\SortCollection\CollectionNormalizer;
use Ifraktal\HelperBundle\Helper\SortCollection\PropertiesNormalizer;
use Ifraktal\HelperBundle\Helper\SortCollection\SortCollection;

/**
 * Class SortCollectionTest
 *
 * @package Ifraktal\HelperBundle\Tests\Helper\SortCollection
 * @author David Amigo <davamigo@gmail.com>
 */
class SortCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var  SortCollection
     */
    private $sortCollection;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sortCollection = null;
    }

    /**
     * Sets up the fixture, creating the required objects.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->sortCollection = new SortCollection(
            new CollectionNormalizer(),
            new PropertiesNormalizer()
        );
    }

    /**
     * Sort Array By One Property Will Return Sorted Array
     */
    public function testSortArrayByOnePropertyWillReturnSortedArray()
    {
        $expected = array(
            array( 'fruit' => 'apple' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'kiwi' ),
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'orange' ),
        );

        $collection = array(
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'apple' ),
            array( 'fruit' => 'orange' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'kiwi' ),
        );

        $properties = 'fruit';

        $result = $this->sortCollection->sortCollection(
            $collection,
            $properties,
            SortCollection::SORT_DIR_ASC
        );

        $this->assertEquals($expected, $result);
    }

    /**
     * Sort Array By One Property With Duplicates Will Return Sorted Array
     */
    public function testSortArrayByOnePropertyWithDuplicatesWillReturnSortedArray()
    {
        $expected = array(
            array( 'fruit' => 'apple' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'kiwi' ),
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'orange' ),
        );

        $collection = array(
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'apple' ),
            array( 'fruit' => 'orange' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'kiwi' ),
        );

        $properties = 'fruit';

        $result = $this->sortCollection->sortCollection(
            $collection,
            $properties,
            SortCollection::SORT_DIR_ASC
        );

        $this->assertEquals($expected, $result);
    }

    /**
     * Sort Array By One Property NullValues Will Return Sorted Array
     */
    public function testSortArrayByOnePropertyWithNullValuesWillReturnSortedArray()
    {
        $expected = array(
            array( 'fruit' => 'apple' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'kiwi' ),
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'orange' ),
            array( 'fruit' => null ),
            array( 'fruit' => null ),
        );

        $collection = array(
            array( 'fruit' => 'melon' ),
            array( 'fruit' => null ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'apple' ),
            array( 'fruit' => 'orange' ),
            array( 'fruit' => null ),
            array( 'fruit' => 'kiwi' ),
        );

        $properties = 'fruit';

        $result = $this->sortCollection->sortCollection(
            $collection,
            $properties,
            SortCollection::SORT_DIR_ASC
        );

        $this->assertEquals($expected, $result);
    }

    /**
     * Sort Array By One Property In Descendant Order Will Return Sorted Array
     */
    public function testSortArrayByOnePropertyInDescendantOrderWillReturnSortedArray()
    {
        $expected = array(
            array( 'fruit' => 'orange' ),
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'kiwi' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'apple' ),
        );

        $collection = array(
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'apple' ),
            array( 'fruit' => 'orange' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'kiwi' ),
        );

        $properties = 'fruit';

        $result = $this->sortCollection->sortCollection(
            $collection,
            $properties,
            SortCollection::SORT_DIR_DESC
        );

        $this->assertEquals($expected, $result);
    }

    /**
     * Sort Array By Two Properties Will Return Sorted Array
     */
    public function testSortArrayByTwoPropertiesWillReturnSortedArray()
    {
        $expected = array(
            array( 'fruit' => 'kiwi',   'color' => 'brown' ),
            array( 'fruit' => 'apple',  'color' => 'green' ),
            array( 'fruit' => 'melon',  'color' => 'green' ),
            array( 'fruit' => 'orange', 'color' => 'orange' ),
            array( 'fruit' => 'banana', 'color' => 'yellow' ),
        );

        $collection = array(
            array( 'fruit' => 'melon',  'color' => 'green' ),
            array( 'fruit' => 'apple',  'color' => 'green' ),
            array( 'fruit' => 'orange', 'color' => 'orange' ),
            array( 'fruit' => 'banana', 'color' => 'yellow' ),
            array( 'fruit' => 'kiwi',   'color' => 'brown' ),
        );

        $properties = array( 'color', 'fruit');

        $result = $this->sortCollection->sortCollection(
            $collection,
            $properties,
            SortCollection::SORT_DIR_ASC
        );

        $this->assertEquals($expected, $result);
    }

    /**
     * Sort Array By Multi Level Property Will Return Sorted Array
     */
    public function testSortArrayByMultiLevelPropertyWillReturnSortedArray()
    {
        $expected = array(
            array( 'fruit' => 'kiwi',   'color' => array( 'internal' => 'green',  'external' => 'brown' ) ),
            array( 'fruit' => 'orange', 'color' => array( 'internal' => 'orange', 'external' => 'orange' ) ),
            array( 'fruit' => 'apple',  'color' => array( 'internal' => 'white',  'external' => 'green' ) ),
            array( 'fruit' => 'melon',  'color' => array( 'internal' => 'white',  'external' => 'green' ) ),
            array( 'fruit' => 'banana', 'color' => array( 'internal' => 'white',  'external' => 'yellow' ) ),
        );

        $collection = array(
            array( 'fruit' => 'melon',  'color' => array( 'internal' => 'white',  'external' => 'green' ) ),
            array( 'fruit' => 'apple',  'color' => array( 'internal' => 'white',  'external' => 'green' ) ),
            array( 'fruit' => 'orange', 'color' => array( 'internal' => 'orange', 'external' => 'orange' ) ),
            array( 'fruit' => 'banana', 'color' => array( 'internal' => 'white',  'external' => 'yellow' ) ),
            array( 'fruit' => 'kiwi',   'color' => array( 'internal' => 'green',  'external' => 'brown' ) ),
        );

        $properties = array(
            'color.internal',
            'color.external',
            'fruit'
        );

        $result = $this->sortCollection->sortCollection(
            $collection,
            $properties,
            SortCollection::SORT_DIR_ASC
        );

        $this->assertEquals($expected, $result);
    }

    /**
     * Sort Array With Invalid Order Will Sort The Array Ascending
     */
    public function testSortArrayWithInvalidOrderWillSortTheArrayAscending()
    {
        $expected = array(
            array( 'fruit' => 'apple' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'kiwi' ),
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'orange' ),
        );

        $collection = array(
            array( 'fruit' => 'melon' ),
            array( 'fruit' => 'apple' ),
            array( 'fruit' => 'orange' ),
            array( 'fruit' => 'banana' ),
            array( 'fruit' => 'kiwi' ),
        );

        $properties = 'fruit';

        $result = $this->sortCollection->sortCollection(
            $collection,
            $properties,
            'test'
        );

        $this->assertEquals($expected, $result);
    }
}
