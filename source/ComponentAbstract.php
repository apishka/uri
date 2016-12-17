<?php

namespace Apishka\Uri;

/**
 * Component abstract
 */

abstract class ComponentAbstract
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

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

    /**
     * Is empty
     *
     * @return bool
     */

    abstract public function isEmpty();
}
