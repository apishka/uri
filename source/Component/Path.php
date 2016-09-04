<?php namespace Apishka\Uri\Component;

/**
 * Path
 */

class Path
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * Path
     *
     * @var string
     */

    private $_path;

    /**
     * Construct
     *
     * @param string $path
     */

    public function __construct($path)
    {
        $this->_path = $path;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->_path;
    }
}
