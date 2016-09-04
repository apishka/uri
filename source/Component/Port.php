<?php namespace Apishka\Uri\Component;

/**
 * Port
 */

class Port
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

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
     */

    public function __construct($port)
    {
        $this->_port = $port;
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
}
