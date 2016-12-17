<?php

namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Pass
 */

class Pass extends ComponentAbstract
{
    /**
     * Pass
     *
     * @var string
     */

    private $_pass;

    /**
     * Construct
     *
     * @param string $pass
     * @param array  $options
     */

    public function __construct($pass, $options = array())
    {
        $this->setOptions($options);
        $this->parse($pass);
    }

    /**
     * Parse
     *
     * @param string $pass
     *
     * @return Pass this
     */

    protected function parse($pass)
    {
        $this->_pass = (string) $pass;

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->_pass;
    }

    /**
     * Is empty
     *
     * @return bool
     */

    public function isEmpty()
    {
        return $this->_pass === '';
    }
}
