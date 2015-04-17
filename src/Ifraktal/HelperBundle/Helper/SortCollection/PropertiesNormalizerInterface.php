<?php

namespace Ifraktal\HelperBundle\Helper\SortCollection;

/**
 * Interface PropertiesNormalizerInterface - Normalizes the properties to sort
 *
 * @package Ifraktal\HelperBundle\Helper\SortCollection
 * @author David Amigo <davamigo@gmail.com>
 */
interface PropertiesNormalizerInterface
{
    /**
     * Convert the properties to an array. The properties can be a single string or an array.
     *
     * @param $properties
     * @return array
     */
    public function normalizeProperties($properties);

    /**
     * Explode single property components. A property can be "prop1.prop2.prop3".
     *
     * @param $property
     * @return array
     */
    public static function getPropertyComponents($property);
}
