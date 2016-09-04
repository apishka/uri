<?php namespace Apishka\Uri\Component;

/**
 * Pass
 */

class Pass
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

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
     */

    public function __construct($pass)
    {
        $this->_pass = $pass;
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
}
