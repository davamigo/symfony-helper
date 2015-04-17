<?php

namespace Ifraktal\HelperBundle\Helper\SortCollection;

use Doctrine\Common\Collections\Collection;

/**
 * Class CollectionNormalizer - Normalizes a collection
 *
 * @package Ifraktal\HelperBundle\Helper\SortCollection
 * @author David Amigo <davamigo@gmail.com>
 */
class CollectionNormalizer implements CollectionNormalizerInterface
{
    /**
     * Convert a collection into an array
     *
     * @param Collection|array $collection
     * @return array
     */
    public function normalizeCollection($collection)
    {
        if ($collection instanceof Collection
            || method_exists($collection, 'getValues')) {
            return $collection->getValues();
        }

        if (is_array($collection)) {
            return $collection;
        }

        return array();
    }
}
