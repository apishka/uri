<?php

namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Path
 */

class Path extends ComponentAbstract
{
    /**
     * Path
     *
     * @var string
     */

    private $_path;

    /**
     * Construct
     *
     * @param string $path
     * @param array  $options
     */

    public function __construct($path, $options = array())
    {
        $this->setOptions($options);
        $this->parse($path);
    }

    /**
     * Parse
     *
     * @param string $path
     *
     * @return Path this
     */

    protected function parse($path)
    {
        $this->_path = (string) $path;

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->_path;
    }

    /**
     * Is empty
     *
     * @return bool
     */

    public function isEmpty()
    {
        return $this->_path === '';
    }
}
