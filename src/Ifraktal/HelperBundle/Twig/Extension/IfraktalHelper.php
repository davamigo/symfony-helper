<?php

namespace Ifraktal\HelperBundle\Twig\Extension;

use Ifraktal\HelperBundle\Helper\SortCollection\SortCollection;

/**
 * Class IfraktalHelper
 *
 * @package Ifraktal\HelperBundle\Twig\Extension
 * @author David Amigo <davamigo@gmail.com>
 */
class IfraktalHelper extends \Twig_Extension
{
    /**
     * @var SortCollection
     */
    private $sortCollection;

    /**
     * Constructor
     *
     * @param SortCollection $sortCollection
     */
    public function __construct(SortCollection $sortCollection)
    {
        $this->sortCollection = $sortCollection;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ifraktal_twig_helper';
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('sortCollection', array($this, 'sortCollection'))
        );
    }

    /**
     * Sorts a collection.
     *
     * Examples:
     *
     *   {% for item in list | sortCollection('field', 'asc') %} (...) {% endfor %}
     *   {% for item in list | sortCollection(['field1', 'field2']) %} (...) {% endfor %}
     *   {% for item in list | sortCollection('field.subfield', 'desc') %} (...) {% endfor %}
     *
     * @param $collection
     * @param $properties
     * @param $dir
     * @return array
     */
    public function sortCollection($collection, $properties, $dir = SortCollection::SORT_DIR_ASC)
    {
        return $this->sortCollection->sortCollection($collection, $properties, $dir);
    }
}
