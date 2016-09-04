<?php namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Scheme
 */

class Scheme extends ComponentAbstract
{
    /**
     * Scheme
     *
     * @var string
     */

    private $_scheme = null;

    /**
     * Construct
     *
     * @param string $scheme
     * @param array  $options
     */

    public function __construct($scheme, $options = array())
    {
        $this->setOptions($options);
        $this->parse($scheme);
    }

    /**
     * Parse
     *
     * @param string $scheme
     *
     * @return Scheme this
     */

    protected function parse($scheme)
    {
        $this->_scheme = strtolower($scheme);

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->_scheme;
    }

    /**
     * Get scheme ports
     *
     * @return array
     */

    public function getSchemePorts()
    {
        return array(
            'http'  => 80,
            'https' => 443,
        );
    }

    /**
     * Get default port
     */

    public function getDefaultPort()
    {
        $ports = $this->getSchemePorts();

        if (array_key_exists($this->_scheme, $ports))
            return $ports[$this->_scheme];

        return false;
    }

    /**
     * Is default port
     *
     * @param int $port
     *
     * @return bool
     */

    public function isDefaultPort($port)
    {
        if ($this->getDefaultPort() !== false)
            return $this->getDefaultPort() == (string) $port;

        return false;
    }

    /**
     * Is empty
     *
     * @return bool
     */

    public function isEmpty()
    {
        return $this->_scheme === '';
    }
}
