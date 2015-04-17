<?php

namespace Ifraktal\HelperBundle\Helper\SortCollection;

use Doctrine\Common\Collections\Collection;

/**
 * Class SortCollection
 *
 * @package Ifraktal\HelperBundle\Helper\SortCollection
 * @author David Amigo <davamigo@gmail.com>
 */
class SortCollection
{
    /**
     * @var CollectionNormalizerInterface
     */
    private $collectionNormalizer;

    /**
     * @var PropertiesNormalizerInterface
     */
    private $propertiesNormalizer;

    /**
     * Constructor
     *
     * @param CollectionNormalizerInterface $collectionNormalizer
     * @param PropertiesNormalizerInterface $propertiesNormalizer
     */
    public function __construct(
        CollectionNormalizerInterface $collectionNormalizer,
        PropertiesNormalizerInterface $propertiesNormalizer
    ) {
        $this->collectionNormalizer = $collectionNormalizer;
        $this->propertiesNormalizer = $propertiesNormalizer;
    }

    /**
     * Constants
     */
    const SORT_DIR_ASC  = 'asc';
    const SORT_DIR_DESC = 'desc';

    /**
     * Sorts a collection
     *
     * @param array|Collection $collection
     * @param array|string $properties
     * @param string $dir
     * @return array
     */
    public function sortCollection($collection, $properties, $dir = SortCollection::SORT_DIR_ASC)
    {
        // Normalize the collection
        $collection = $this->collectionNormalizer->normalizeCollection($collection);

        // Normalize the sort properties
        $properties = $this->propertiesNormalizer->normalizeProperties($properties);

        // For PHP 5.3
        $thisClass = $this;

        // Sort the collection using user defined function
        usort($collection, function ($item1, $item2) use ($thisClass, $properties, $dir) {
            switch ($dir) {
                default:
                case SortCollection::SORT_DIR_ASC:
                    return $thisClass->compareCollectionItems($item1, $item2, $properties);

                case SortCollection::SORT_DIR_DESC:
                    return $thisClass->compareCollectionItems($item2, $item1, $properties);
            }
        });

        return $collection;
    }

    /**
     * Compare two collection items using the properties
     *
     * @param array|object|mixed $item1
     * @param array|object|mixed $item2
     * @param array $properties
     * @return int (-1, 0, 1)
     */
    public function compareCollectionItems($item1, $item2, array $properties)
    {
        // For each property...
        foreach ($properties as $property) {

            // Temporal objects
            $value1 = $item1;
            $value2 = $item2;

            // Extract inner values using property components
            $components = $this->propertiesNormalizer->getPropertyComponents($property);

            foreach ($components as $component) {
                $value1 = $this->extractInnerValue($value1, $component);
                $value2 = $this->extractInnerValue($value2, $component);
            }

            // Compare inner values with ascending sort
            if ($value1 !== null && $value2 === null) {
                return -1;
            }

            if ($value1 === null && $value2 !== null) {
                return +1;
            }

            if ($value1 < $value2) {
                return -1;
            }

            if ($value1 > $value2) {
                return +1;
            }
        }

        // The two objects are equal
        return 0;
    }

    /**
     * Extracts the property value of a source object
     *
     * @param object|array $source
     * @param string $property
     * @return object|array|null
     */
    protected function extractInnerValue($source, $property)
    {
        if (null === $source || null === $property || !is_string($property)) {
            return null;
        }

        if (is_array($source)) {

            if (isset($source[$property])) {
                return $source[$property];
            }

            return null;
        }

        if (is_object($source)) {

            if (isset($source->$property)) {
                return $source->$property;
            }

            if (method_exists($source, $property)) {
                return $source->$property();
            }

            $method = 'get' . $property;
            if (method_exists($source, $method)) {
                return $source->$method();
            }

            $method = 'is' . $property;
            if (method_exists($source, $method)) {
                return $source->$method();
            }
        }

        return null;
    }
}
