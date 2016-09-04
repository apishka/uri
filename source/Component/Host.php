<?php namespace Apishka\Uri\Component;

/**
 * Host
 */

class Host
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * Host
     *
     * @var string
     */

    private $_host;

    /**
     * Construct
     *
     * @param string $host
     */

    public function __construct($host)
    {
        $this->_host = $host;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->_host;
    }
}
