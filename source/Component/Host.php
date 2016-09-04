<?php namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Host
 */

class Host extends ComponentAbstract
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
     * @param array  $options
     */

    public function __construct($host, $options = array())
    {
        $this->setOptions($options);
        $this->parse($host);
    }

    /**
     * Parse
     *
     * @param string $host
     *
     * @return Host this
     */

    protected function parse($host)
    {
        $this->_host = function_exists('mb_strtolower')
            ? mb_strtolower($host)
            : strtolower($host)
        ;

        return $this;
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
