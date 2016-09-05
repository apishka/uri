<?php namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Query
 */

class Query extends ComponentAbstract implements \ArrayAccess
{
    /**
     * Query
     *
     * @var string
     */

    private $_query = array();

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
        if (is_array($query))
        {
            $this->_query = $query;
        }
        else
        {
            parse_str($query, $this->_query);
        }

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) http_build_query($this->_query);
    }

    /**
     * Set
     *
     * @param mixed $key
     * @param mixed $value
     *
     * @return Query
     */

    public function set($key, $value)
    {
        $this->offsetSet($key, $value);

        return $this;
    }

    /**
     * Set multi
     *
     * @param array $values
     *
     * @return Query
     */

    public function setMulti(array $values)
    {
        foreach ($values as $key => $value)
            $this->set($key, $value);

        return $this;
    }

    /**
     * Get
     *
     * @param mixed $key
     *
     * @return mixed
     */

    public function get($key)
    {
        return $this->offsetGet($key);
    }

    /**
     * Has
     *
     * @param mixed $key
     *
     * @return bool
     */

    public function has($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Del
     *
     * @param mixed $key
     *
     * @return Query
     */

    public function del($key)
    {
        $this->offsetUnset($key);

        return $this;
    }

    /**
     * Apply
     *
     * @param array $values
     *
     * @return Query
     */

    public function apply(array $values)
    {
        foreach ($values as $key => $value)
        {
            if ($value === false)
            {
                $this->offsetUnset($key);
            }
            else
            {
                $this->offsetSet($key, $value);
            }
        }

        return $this;
    }

    /**
     * Offset exists
     *
     * @param mixed $offset
     *
     * @return bool
     */

    public function offsetExists($offset)
    {
        return isset($this->_query[$offset]);
    }

    /**
     * Offset get
     *
     * @param mixed $offset
     *
     * @return mixed
     */

    public function offsetGet($offset)
    {
        return $this->_query[$offset];
    }

    /**
     * Offset set
     *
     * @param mixed $offset
     * @param mixed $value
     */

    public function offsetSet($offset, $value)
    {
        $this->_query[$offset] = $value;
    }

    /**
     * Offset unset
     *
     * @param mixed $offset
     */

    public function offsetUnset($offset)
    {
        if (is_array($offset))
        {
            $prev = null;

            $curr = &$this->_query;
            foreach ($offset as $key)
            {
                $prev = &$curr;
                $curr = &$curr[$key];
            }

            if ($prev !== null)
                unset($prev[$key]);
        }
        else
        {
            unset($this->_query[$offset]);
        }
    }

    /**
     * Is empty
     *
     * @return bool
     */

    public function isEmpty()
    {
        return empty($this->_query);
    }
}
