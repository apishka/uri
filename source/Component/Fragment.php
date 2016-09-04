<?php namespace Apishka\Uri\Component;

/**
 * Fragment
 */

class Fragment
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * Fragment
     *
     * @var string
     */

    private $_fragment;

    /**
     * Construct
     *
     * @param string $fragment
     */

    public function __construct($fragment)
    {
        $this->_fragment = $fragment;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->_fragment;
    }
}
