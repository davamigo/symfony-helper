<?php

namespace Ifraktal\HelperBundle\Helper\SortCollection;

/**
 * Interface CollectionNormalizerInterface - Normalizes a collection to sort
 *
 * @package Ifraktal\HelperBundle\Helper\SortCollection
 * @author David Amigo <davamigo@gmail.com>
 */
interface CollectionNormalizerInterface
{
    /**
     * Convert a collection into an array
     *
     * @param $collection
     * @return array
     */
    public function normalizeCollection($collection);
}
