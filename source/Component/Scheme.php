<?php namespace Apishka\Uri\Component;

/**
 * Scheme
 */

class Scheme
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * Scheme
     *
     * @var string
     */

    private $_scheme = null;

    /**
     * Original scheme
     *
     * @var string
     */

    private $_original_scheme = null;

    /**
     * Construct
     *
     * @param string $scheme
     */

    public function __construct($scheme)
    {
        $this->_original_scheme = $scheme;
        $this->parse($scheme);
    }

    /**
     * Parse
     *
     * @param string $scheme
     *
     * @return Scheme
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
     *
     * @return void
     */

    public function getDefaultPort()
    {
        $ports = $this->getSchemePorts();

        if (array_key_exists($this->_scheme, $ports))
            return $ports[$this->_scheme];

        return false;
    }
}
