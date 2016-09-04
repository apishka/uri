<?php namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Port
 */

class Port extends ComponentAbstract
{
    /**
     * Port
     *
     * @var string
     */

    private $_port;

    /**
     * Construct
     *
     * @param string $port
     * @param array  $options
     */

    public function __construct($port, $options = array())
    {
        $this->setOptions($options);
        $this->parse($port);
    }

    /**
     * Parse
     *
     * @param string $port
     *
     * @return Port this
     */

    protected function parse($port)
    {
        $this->_port = (int) $port;

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->_port;
    }

    /**
     * Is empty
     *
     * @return bool
     */

    public function isEmpty()
    {
        return $this->_port === 0;
    }
}
