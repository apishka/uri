<?php namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Host
 */

class Host extends ComponentAbstract
{
    /**
     * Host
     *
     * @var string
     */

    private $_host;

    /**
     * Construct
     *
     * @param mixed $host
     * @param array $options
     */

    public function __construct($host, $options = array())
    {
        $this->setOptions($options);
        $this->parse($host);
    }

    /**
     * Is empty
     *
     * @return bool
     */

    public function isEmpty()
    {
        return $this->_host === '';
    }

    /**
     * Parse
     *
     * @param mixed $host
     *
     * @return Host this
     */

    protected function parse($host)
    {
        if (is_array($host))
            $host = implode('.', $host);

        $host = (string) $host;

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
