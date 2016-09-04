<?php namespace Apishka\Uri\Component;

/**
 * Query
 */

class Query
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
     */

    public function __construct($query)
    {
        $this->_query = $query;
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
