<?php namespace Apishka\Uri;

use Apishka\Uri\ComponentAbstract;

/**
 * Component abstract
 */

abstract class ComponentAbstract
{
    /**
     * Options
     *
     * @var array
     */

    protected $_options = array();

    /**
     * Set options
     *
     * @param array $options
     *
     * @return ComponentAbstract this
     */

    protected function setOptions($options)
    {
        $this->_options = $options;
    }
}
