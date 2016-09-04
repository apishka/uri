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

    private $_scheme;

    /**
     * Construct
     *
     * @param string $scheme
     */

    public function __construct($scheme)
    {
        $this->_scheme = $scheme;
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
}
