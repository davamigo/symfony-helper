<?php

namespace Ifraktal\HelperBundle\Helper\SortCollection;

/**
 * Class PropertiesNormalizer - Normalizes the properties to sort
 *
 * @package Ifraktal\HelperBundle\Helper\SortCollection
 * @author David Amigo <davamigo@gmail.com>
 */
class PropertiesNormalizer implements PropertiesNormalizerInterface
{
    /**
     * Convert the properties to an array. The properties can be a single string or an array.
     *
     * @param $properties
     * @return array
     */
    public function normalizeProperties($properties)
    {
        if (is_array($properties)) {
            return $properties;
        }

        if (is_string($properties)) {
            return array($properties);
        }

        return array();
    }

    /**
     * Explode single property components. A property can be "prop1.prop2.prop3".
     *
     * @param string|array $property
     * @return array
     */
    public static function getPropertyComponents($property)
    {
        if (is_string($property)) {
            return explode('.', $property);
        }

        if (is_array($property)) {
            return $property;
        }

        return array();
    }
}
