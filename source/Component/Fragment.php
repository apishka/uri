<?php namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Fragment
 */

class Fragment extends ComponentAbstract
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
     * @param array  $options
     */

    public function __construct($fragment, $options = array())
    {
        $this->setOptions($options);
        $this->parse($fragment);
    }

    /**
     * Parse
     *
     * @param string $fragment
     *
     * @return Fragment this
     */

    protected function parse($fragment)
    {
        $this->_fragment = (string) $fragment;

        return $this;
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

    /**
     * Is empty
     *
     * @return bool
     */

    public function isEmpty()
    {
        return $this->_fragment === '';
    }
}
