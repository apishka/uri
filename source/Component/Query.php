<?php namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Query
 */

class Query extends ComponentAbstract
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * Query
     *
     * @var string
     */

    private $_query;

    /**
     * Construct
     *
     * @param string $query
     * @param array  $options
     */

    public function __construct($query, $options = array())
    {
        $this->setOptions($options);
        $this->parse($query);
    }

    /**
     * Parse
     *
     * @param string $query
     *
     * @return Query this
     */

    protected function parse($query)
    {
        $this->_query = $query;

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->_query;
    }
}
